<?php

class Bragbook_Updater {

	private string $file;
	private array $plugin = [];
	private string $basename = '';
	private bool $active = false;
	private string $username = 'bragbook';
	private string $repository = 'BRAGbook';
	private ?string $authorize_token = null;
	private array $github_response = [];

	public function __construct(string $file) {
		$this->file = $file;
		add_action('admin_init', [$this, 'set_plugin_properties']);
	}

	public function set_plugin_properties(): void {
		$this->plugin = get_plugin_data($this->file);
		$this->basename = plugin_basename($this->file);
		$this->active = is_plugin_active($this->basename);
	}

	public function set_username(string $username): void {
		$this->username = $username;
	}

	public function set_repository(string $repository): void {
		$this->repository = $repository;
	}

	public function authorize(string $token): void {
		$this->authorize_token = $token;
	}

	private function get_repository_info(): void {
		if (!empty($this->github_response)) {
			return;
		}

		$request_uri = sprintf('https://api.github.com/repos/%s/%s/releases/latest', $this->username, $this->repository);

		$args = [
			'headers' => [
				'Accept' => 'application/vnd.github.v3+json',
				'User-Agent' => 'WordPress/' . get_bloginfo('version'),
			]
		];

		if ($this->authorize_token) {
			$args['headers']['Authorization'] = 'token ' . $this->authorize_token;
		}

		$response = wp_remote_get($request_uri, $args);

		if (is_wp_error($response)) {
			return;
		}

		$data = json_decode(wp_remote_retrieve_body($response), true);

		if (is_array($data)) {
			$this->github_response = $data;
		}
	}

	public function initialize(): void {
		add_filter('pre_set_site_transient_update_plugins', [$this, 'modify_transient']);
		add_filter('plugins_api', [$this, 'plugin_popup'], 10, 3);
		add_filter('upgrader_post_install', [$this, 'after_install'], 10, 3);
	}

	public function modify_transient($transient) {
		if (!property_exists($transient, 'checked')) {
			return $transient;
		}

		$this->get_repository_info();

		$checked = $transient->checked;
		$current_version = $checked[$this->basename] ?? null;
		$remote_version = $this->github_response['tag_name'] ?? null;

		if ($current_version && $remote_version && version_compare($remote_version, $current_version, '>')) {
			$slug = current(explode('/', $this->basename));
			$plugin = [
				'url'         => $this->plugin['PluginURI'] ?? '',
				'slug'        => $slug,
				'package'     => $this->github_response['zipball_url'],
				'new_version' => $remote_version,
			];
			$transient->response[$this->basename] = (object) $plugin;
		}

		return $transient;
	}

	public function plugin_popup($result, $action, $args) {
		if ($action !== 'plugin_information' || empty($args->slug)) {
			return $result;
		}

		if ($args->slug === current(explode('/', $this->basename))) {
			$this->get_repository_info();

			$plugin = [
				'name'              => $this->plugin['Name'] ?? 'BRAGbook',
				'slug'              => $this->basename,
				'version'           => $this->github_response['tag_name'] ?? '',
				'author'            => $this->plugin['AuthorName'] ?? '',
				'author_profile'    => $this->plugin['AuthorURI'] ?? '',
				'last_updated'      => $this->github_response['published_at'] ?? '',
				'homepage'          => $this->plugin['PluginURI'] ?? '',
				'short_description' => $this->plugin['Description'] ?? '',
				'sections'          => [
					'Description' => $this->plugin['Description'] ?? '',
					'Updates'     => $this->github_response['body'] ?? '',
				],
				'download_link'     => $this->github_response['zipball_url'] ?? '',
			];

			return (object) $plugin;
		}

		return $result;
	}

	public function after_install($response, $hook_extra, $result) {
		global $wp_filesystem;

		$install_directory = plugin_dir_path($this->file);
		$wp_filesystem->move($result['destination'], $install_directory);
		$result['destination'] = $install_directory;

		if ($this->active) {
			activate_plugin($this->basename);
		}

		return $result;
	}
}
