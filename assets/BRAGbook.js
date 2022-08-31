// JavaScript Document

//BRAG book™ 1.4.3.4
//© copyright 2013-2022 Candace Crowe Design

function reloadPage() {
	location.reload();
	// var selfUrl = unescape(window.location.pathname);
	//    location.reload(true);
	//
	//    window.location.replace(selfUrl);
	//
	//    window.location.href = selfUrl;
}

var revJquery = jQuery.noConflict();

revJquery(document).ready(function () {
	// load sliders

	//loop to find all instances
	//var bragSliders = revJquery(document).find('.bragSlider');

	//$.each(bragSliders, function( index, value ) {
	// alert( index + ": " + value );
	//});

	revJquery(".bragSlider").each(function () {
		var curSlider = "#" + revJquery(this).attr("id");
		console.log(curSlider);
		revJquery(curSlider).revSlick({
			dots: true,
			arrows: true,
			infinite: true,
			speed: 300,
			slidesToShow: 3,
			slidesToScroll: 3,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
						infinite: true,
						dots: true,
					},
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
	});

	//change out login buttons
	bbButtonExchange2();

	//Initialize infinite scroll on category landing page
	revJquery("#revCategoryImageSets").jscroll({
		autoTrigger: true,
		loadingHtml: "<li>Loading...</li>",
		padding: 20,
		nextSelector: "a.revJscroll-next:last",
	});
	var testResponse;

	//create function and listener for messages from iframe
	testResponse = function (e) {
		if (e.origin == "https://bragbook.gallery") {
			//alert(e.data);
			statusVar = e.data;
			if (statusVar.status == "logout") {
				//alert("logout");
				var serializedDataExit = {
					action: "bragbook_ajax_start",
					patientlogout: "TRUE",
				};
				var ajax_url = wp_vars.ajax_url;
				var pathname = ajax_url;

				requestExit = revJquery.ajax({
					url: pathname,
					type: "get",
					data: serializedDataExit,
				});

				// callback handler that will be called on success
				requestExit.done(function (response, textStatus, jqXHR) {
					// log a message to the console
					//alert("logged out");
					window.location.reload();
				});
			} else if (statusVar.status == "loggedin") {
				//alert(statusVar.status);
				//alert(statusVar.patientsig);

				revJquery(document).off("click", "#revlightcase-overlay");
				revJquery(document).on(
					"click",
					"#revlightcase-overlay",
					function () {
						bbButtonExchange(
							statusVar.patientsig,
							statusVar.patientid,
							statusVar.username
						);
					}
				);

				revJquery(document).off("click", ".revlightcase-icon-close");
				revJquery(document).on(
					"click",
					".revlightcase-icon-close",
					function () {
						bbButtonExchange(
							statusVar.patientsig,
							statusVar.patientid,
							statusVar.username
						);
					}
				);
			}
		}
	};
	window.addEventListener("message", testResponse, false);

	function bbButtonExchange(patientsig, patientid, username) {
		//alert(patientsig);
		var ajax_url = wp_vars.ajax_url;

		//replace fav buttons
		var serializedData = {
			action: "bragbook_ajax_start",
			getFavButton: "TRUE",
			patientSig: patientsig,
			patientid: patientid,
			username: username,
			revCurURL: window.location.href,
		};
		//var pathname = window.location;
		var pathname = ajax_url;
		//alert(serializedData);

		// fire off the request to /editnotes.php
		request = revJquery.ajax({
			url: pathname,
			type: "get",
			data: serializedData,
		});

		// callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR) {
			// log a message to the console
			//alert(response);
			revJquery(".revFavLaunch ").replaceWith(response);

			revJquery("body").off("click", ".revFavLaunch");
			revJquery("body").on("click", ".revFavLaunch", function (e) {
				e.preventDefault();

				revlightcase.start({
					href: revJquery(this).attr("href"),
					shrinkFactor: 0.9,
					maxWidth: "100%",
					maxHeight: "100%",
					iframe: {
						width: "100%",
						height: "100%",
					},
					onCleanup: {
						quux: function () {
							revJquery("#revlightcase-case").remove();
							revJquery("#revlightcase-overlay").remove();
							revJquery("#revlightcase-loading").remove();
							revJquery("#revlightcase-nav").remove();
						},
					},
				});
			});
		});

		//replace login buttons
		var serializedData = {
			action: "bragbook_ajax_start",
			getLoginText: "TRUE",
			patientSig: patientsig,
			patientid: patientid,
			username: username,
			revCurURL: window.location.href,
		};
		var ajax_url = wp_vars.ajax_url;
		//var pathname = window.location.pathname;
		var pathname = ajax_url;
		//alert(serializedData);

		// fire off the request to /editnotes.php
		request = revJquery.ajax({
			url: pathname,
			type: "get",
			data: serializedData,
		});

		// callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR) {
			// log a message to the console
			//alert(response);
			revJquery("#myFavsHeader ").replaceWith(response);

			revJquery("body").on("click", ".revLoginLaunch", function (e) {
				e.preventDefault();

				revlightcase.start({
					href: revJquery(this).attr("href"),
					shrinkFactor: 0.9,
					maxWidth: "100%",
					maxHeight: "100%",
					iframe: {
						width: "100%",
						height: "100%",
					},
					onCleanup: {
						quux: function () {
							revJquery("#revlightcase-case").remove();
							revJquery("#revlightcase-overlay").remove();
							revJquery("#revlightcase-loading").remove();
							revJquery("#revlightcase-nav").remove();
						},
					},
				});
			});
		});
	}

	revJquery("body").on("click", ".revLoginLaunch", function (e) {
		e.preventDefault();

		revlightcase.start({
			href: revJquery(this).attr("href"),
			shrinkFactor: 0.9,
			maxWidth: "100%",
			maxHeight: "100%",
			iframe: {
				width: "100%",
				height: "100%",
			},
			onCleanup: {
				quux: function () {
					revJquery("#revlightcase-case").remove();
					revJquery("#revlightcase-overlay").remove();
					revJquery("#revlightcase-loading").remove();
					revJquery("#revlightcase-nav").remove();
				},
			},
			onClose: {},
		});
	});
	revJquery("body").off("click", ".revFavLaunch");
	revJquery("body").on("click", ".revFavLaunch", function (e) {
		e.preventDefault();

		revlightcase.start({
			href: revJquery(this).attr("href"),
			shrinkFactor: 0.9,
			maxWidth: "100%",
			maxHeight: "100%",
			iframe: {
				width: "100%",
				height: "100%",
			},
			onCleanup: {
				quux: function () {
					revJquery("#revlightcase-case").remove();
					revJquery("#revlightcase-overlay").remove();
					revJquery("#revlightcase-loading").remove();
					revJquery("#revlightcase-nav").remove();
				},
			},
			onClose: {},
		});
	});

	//function to exchange buttons after page load
	function bbButtonExchange2() {
		// alert('x2');
		var ajax_url = wp_vars.ajax_url;

		//replace fav buttons
		var serializedData = {
			action: "bragbook_ajax_start",
			getFavButton: "TRUE",
			patientSig: "",
			patientid: "",
			username: "",
			revCurURL: window.location.href,
		};
		//var pathname = window.location;
		var pathname = ajax_url;
		//alert(serializedData);

		// fire off the request to /editnotes.php
		request = revJquery.ajax({
			url: pathname,
			type: "get",
			data: serializedData,
		});

		// callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR) {
			// log a message to the console
			//alert(response);
			revJquery(".revFavLaunch ").replaceWith(response);

			revJquery("body").off("click", ".revFavLaunch");
			revJquery("body").on("click", ".revFavLaunch", function (e) {
				e.preventDefault();

				revlightcase.start({
					href: revJquery(this).attr("href"),
					shrinkFactor: 0.9,
					maxWidth: "100%",
					maxHeight: "100%",
					iframe: {
						width: "100%",
						height: "100%",
					},
					onCleanup: {
						quux: function () {
							revJquery("#revlightcase-case").remove();
							revJquery("#revlightcase-overlay").remove();
							revJquery("#revlightcase-loading").remove();
							revJquery("#revlightcase-nav").remove();
						},
					},
				});
			});
		});

		//replace login buttons
		var serializedData = {
			action: "bragbook_ajax_start",
			getLoginText: "TRUE",
			patientSig: "",
			patientid: "",
			username: "",
			revCurURL: window.location.href,
		};
		var ajax_url = wp_vars.ajax_url;
		//var pathname = window.location.pathname;
		var pathname = ajax_url;
		//alert(serializedData);

		// fire off the request to /editnotes.php
		request = revJquery.ajax({
			url: pathname,
			type: "get",
			data: serializedData,
		});

		// callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR) {
			// log a message to the console
			//alert(response);
			revJquery("#myFavsHeader ").replaceWith(response);

			revJquery("body").on("click", ".revLoginLaunch", function (e) {
				e.preventDefault();

				revlightcase.start({
					href: revJquery(this).attr("href"),
					shrinkFactor: 0.9,
					maxWidth: "100%",
					maxHeight: "100%",
					iframe: {
						width: "100%",
						height: "100%",
					},
					onCleanup: {
						quux: function () {
							revJquery("#revlightcase-case").remove();
							revJquery("#revlightcase-overlay").remove();
							revJquery("#revlightcase-loading").remove();
							revJquery("#revlightcase-nav").remove();
						},
					},
				});
			});
		});
	}

	revJquery("body").on("click", ".revLoginLaunch", function (e) {
		e.preventDefault();

		revlightcase.start({
			href: revJquery(this).attr("href"),
			shrinkFactor: 0.9,
			maxWidth: "100%",
			maxHeight: "100%",
			iframe: {
				width: "100%",
				height: "100%",
			},
			onCleanup: {
				quux: function () {
					revJquery("#revlightcase-case").remove();
					revJquery("#revlightcase-overlay").remove();
					revJquery("#revlightcase-loading").remove();
					revJquery("#revlightcase-nav").remove();
				},
			},
			onClose: {},
		});
	});
	revJquery("body").off("click", ".revFavLaunch");
	revJquery("body").on("click", ".revFavLaunch", function (e) {
		e.preventDefault();

		revlightcase.start({
			href: revJquery(this).attr("href"),
			shrinkFactor: 0.9,
			maxWidth: "100%",
			maxHeight: "100%",
			iframe: {
				width: "100%",
				height: "100%",
			},
			onCleanup: {
				quux: function () {
					revJquery("#revlightcase-case").remove();
					revJquery("#revlightcase-overlay").remove();
					revJquery("#revlightcase-loading").remove();
					revJquery("#revlightcase-nav").remove();
				},
			},
			onClose: {},
		});
	});

	revJquery("body").on("click", ".revThumbLaunch", function (e) {
		e.preventDefault();

		revlightcase.start({
			href: revJquery(this).attr("href"),
			shrinkFactor: 0.9,
			maxWidth: "100%",
			maxHeight: "100%",
			inline: {
				width: "100%",
				height: "100%",
			},
			onCleanup: {
				quux: function () {
					revJquery("#revlightcase-case").remove();
					revJquery("#revlightcase-overlay").remove();
					revJquery("#revlightcase-loading").remove();
					revJquery("#revlightcase-nav").remove();
				},
			},
			onClose: {},
		});
	});

	// bind to the click event for thumbnail navigation
	revJquery("body").on("click", ".thumbNavLink", function (event) {
		// prevent default posting of form
		event.preventDefault();
		var request;
		if (request) {
			request.abort();
		}

		//var splitVal = revJquery(this).attr('alt');

		//var mySplitResult = splitVal.split("|");
		var revCatname = revJquery(this).data("revcatname");
		var thumbStart = revJquery(this).data("thumbstart");
		var revURL = window.location.href;
		var ajax_url = wp_vars.ajax_url;

		var serializedData =
			"revCatname=" +
			revCatname +
			"&getThumbnails=1&action=bragbook_ajax_start&thumbStart=" +
			thumbStart +
			"&revCurURL=" +
			revURL;

		// fire off the request to /editnotes.php
		request = revJquery.ajax({
			url: ajax_url,
			type: "get",
			data: serializedData,
		});

		// callback handler that will be called on success
		request.done(function (response, textStatus, jqXHR) {
			// log a message to the console
			revJquery("#revThumbnailConDiv").html(response);
		});

		// callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown) {
			// log the error to the console
			console.error(
				"The following error occured: " + textStatus,
				errorThrown
			);
		});

		// callback handler that will be called regardless
		// if the request failed or succeeded
		request.always(function () {
			// reenable the inputs
		});
	});
});

//Jump Menu Functions
function revenez_jump_menu_procedure() {
	var baseURL = revJquery("#revCatname")
		.children("option:selected")
		.data("baseurl");
	var sectionvar = revJquery("#revCatname")
		.children("option:selected")
		.data("sectionvar");
	window.location = baseURL + sectionvar + "/";
}

function revenez_jump_menu_procedure_norewrite() {
	var baseURL = revJquery("#revCatname")
		.children("option:selected")
		.data("baseurl");
	var sectionvar = revJquery("#revCatname")
		.children("option:selected")
		.data("sectionvar");
	window.location = baseURL + "?revCatname=" + sectionvar;
}

/*
 * Lightcase - jQuery Plugin
 * The smart and flexible Lightbox Plugin.
 *
 * @author		Cornel Boppart <cornel@bopp-art.com>
 * @copyright	Author
 *
 * @version		2.3.6 (20/12/2016)
 */

(function ($) {
	"use strict";

	var _self = {
		cache: {},

		support: {},

		objects: {},

		/**
		 * Initializes the plugin
		 *
		 * @param	{object}	options
		 * @return	{object}
		 */
		init: function (options) {
			return this.each(function () {
				$(this)
					.unbind("click.revlightcase")
					.bind("click.revlightcase", function (event) {
						event.preventDefault();
						$(this).revlightcase("start", options);
					});
			});
		},

		/**
		 * Starts the plugin
		 *
		 * @param	{object}	options
		 * @return	{void}
		 */
		start: function (options) {
			_self.origin = revlightcase.origin = this;

			_self.settings = revlightcase.settings = $.extend(
				true,
				{
					idPrefix: "revlightcase-",
					classPrefix: "revlightcase-",
					attrPrefix: "revlc-",
					transition: "elastic",
					transitionIn: null,
					transitionOut: null,
					cssTransitions: true,
					speedIn: 250,
					speedOut: 250,
					maxWidth: 800,
					maxHeight: 500,
					forceWidth: false,
					forceHeight: false,
					liveResize: true,
					fullScreenModeForMobile: true,
					mobileMatchExpression:
						/(iphone|ipod|ipad|android|blackberry|symbian)/,
					disableShrink: false,
					shrinkFactor: 0.75,
					overlayOpacity: 0.9,
					slideshow: false,
					slideshowAutoStart: true,
					timeout: 5000,
					swipe: true,
					useKeys: true,
					useCategories: true,
					navigateEndless: true,
					closeOnOverlayClick: true,
					title: null,
					caption: null,
					showTitle: true,
					showCaption: true,
					showSequenceInfo: true,
					inline: {
						width: "auto",
						height: "auto",
					},
					ajax: {
						width: "auto",
						height: "auto",
						type: "get",
						dataType: "html",
						data: {},
					},
					iframe: {
						width: 800,
						height: 500,
						frameborder: 0,
						allowtransparency: true,
					},
					flash: {
						width: 400,
						height: 205,
						wmode: "transparent",
					},
					video: {
						width: 400,
						height: 225,
						poster: "",
						preload: "auto",
						controls: true,
						autobuffer: true,
						autoplay: true,
						loop: false,
					},
					attr: "data-rel",
					href: null,
					type: null,
					typeMapping: {
						image: "jpg,jpeg,gif,png,bmp",
						flash: "swf",
						video: "mp4,mov,ogv,ogg,webm",
						iframe: "html,php",
						ajax: "json,txt",
						inline: "#",
					},
					errorMessage: function () {
						return (
							'<p class="' +
							_self.settings.classPrefix +
							'error">' +
							_self.settings.labels["errorMessage"] +
							"</p>"
						);
					},
					labels: {
						errorMessage: "Source could not be found...",
						"sequenceInfo.of": " of ",
						close: "Close",
						"navigator.prev": "Prev",
						"navigator.next": "Next",
						"navigator.play": "Play",
						"navigator.pause": "Pause",
					},
					markup: function () {
						$("body").append(
							(_self.objects.overlay = $(
								'<div id="' +
									_self.settings.idPrefix +
									'overlay"></div>'
							)),
							(_self.objects.loading = $(
								'<div id="' +
									_self.settings.idPrefix +
									'loading" class="' +
									_self.settings.classPrefix +
									'icon-spin"></div>'
							)),
							(_self.objects.case = $(
								'<div id="' +
									_self.settings.idPrefix +
									'case" aria-hidden="true" role="dialog"></div>'
							))
						);
						_self.objects.case.after(
							(_self.objects.nav = $(
								'<div id="' +
									_self.settings.idPrefix +
									'nav"></div>'
							))
						);
						_self.objects.nav.append(
							(_self.objects.close = $(
								'<a href="#" class="' +
									_self.settings.classPrefix +
									'icon-close"><span>' +
									_self.settings.labels["close"] +
									"</span></a>"
							)),
							(_self.objects.prev = $(
								'<a href="#" class="' +
									_self.settings.classPrefix +
									'icon-prev"><span>' +
									_self.settings.labels["navigator.prev"] +
									"</span></a>"
							).hide()),
							(_self.objects.next = $(
								'<a href="#" class="' +
									_self.settings.classPrefix +
									'icon-next"><span>' +
									_self.settings.labels["navigator.next"] +
									"</span></a>"
							).hide()),
							(_self.objects.play = $(
								'<a href="#" class="' +
									_self.settings.classPrefix +
									'icon-play"><span>' +
									_self.settings.labels["navigator.play"] +
									"</span></a>"
							).hide()),
							(_self.objects.pause = $(
								'<a href="#" class="' +
									_self.settings.classPrefix +
									'icon-pause"><span>' +
									_self.settings.labels["navigator.pause"] +
									"</span></a>"
							).hide())
						);
						_self.objects.case.append(
							(_self.objects.content = $(
								'<div id="' +
									_self.settings.idPrefix +
									'content"></div>'
							)),
							(_self.objects.info = $(
								'<div id="' +
									_self.settings.idPrefix +
									'info"></div>'
							))
						);
						_self.objects.content.append(
							(_self.objects.contentInner = $(
								'<div class="' +
									_self.settings.classPrefix +
									'contentInner"></div>'
							))
						);
						_self.objects.info.append(
							(_self.objects.sequenceInfo = $(
								'<div id="' +
									_self.settings.idPrefix +
									'sequenceInfo"></div>'
							)),
							(_self.objects.title = $(
								'<h4 id="' +
									_self.settings.idPrefix +
									'title"></h4>'
							)),
							(_self.objects.caption = $(
								'<p id="' +
									_self.settings.idPrefix +
									'caption"></p>'
							))
						);
					},
					onInit: {},
					onStart: {},
					onFinish: {},
					onClose: {},
					onCleanup: {},
				},
				options,
				// Load options from data-lc-options attribute
				_self.origin.data ? _self.origin.data("lc-options") : {}
			);

			// Call onInit hook functions
			_self._callHooks(_self.settings.onInit);

			_self.objectData = _self._setObjectData(this);

			_self._cacheScrollPosition();
			_self._watchScrollInteraction();

			_self._addElements();
			_self._open();

			_self.dimensions = _self.getViewportDimensions();
		},

		/**
		 * Getter method for objects
		 *
		 * @param	{string}	name
		 * @return	{object}
		 */
		get: function (name) {
			return _self.objects[name];
		},

		/**
		 * Getter method for objectData
		 *
		 * @return	{object}
		 */
		getObjectData: function () {
			return _self.objectData;
		},

		/**
		 * Sets the object data
		 *
		 * @param	{object}	object
		 * @return	{object}	objectData
		 */
		_setObjectData: function (object) {
			var $object = $(object),
				objectData = {
					title:
						_self.settings.title ||
						$object.attr(_self._prefixAttributeName("title")) ||
						$object.attr("title"),
					caption:
						_self.settings.caption ||
						$object.attr(_self._prefixAttributeName("caption")) ||
						$object.children("img").attr("alt"),
					url: _self._determineUrl(),
					requestType: _self.settings.ajax.type,
					requestData: _self.settings.ajax.data,
					requestDataType: _self.settings.ajax.dataType,
					rel: $object.attr(_self._determineAttributeSelector()),
					type:
						_self.settings.type ||
						_self._verifyDataType(_self._determineUrl()),
					isPartOfSequence: _self._isPartOfSequence(
						$object.attr(_self.settings.attr),
						":"
					),
					isPartOfSequenceWithSlideshow: _self._isPartOfSequence(
						$object.attr(_self.settings.attr),
						":slideshow"
					),
					currentIndex: $(_self._determineAttributeSelector()).index(
						$object
					),
					sequenceLength: $(_self._determineAttributeSelector())
						.length,
				};

			// Add sequence info to objectData
			objectData.sequenceInfo =
				objectData.currentIndex +
				1 +
				_self.settings.labels["sequenceInfo.of"] +
				objectData.sequenceLength;

			// Add next/prev index
			objectData.prevIndex = objectData.currentIndex - 1;
			objectData.nextIndex = objectData.currentIndex + 1;

			return objectData;
		},

		/**
		 * Prefixes a data attribute name with defined name from 'settings.attrPrefix'
		 * to ensure more uniqueness for all lightcase related/used attributes.
		 *
		 * @param	{string}	name
		 * @return	{string}
		 */
		_prefixAttributeName: function (name) {
			return "data-" + _self.settings.attrPrefix + name;
		},

		/**
		 * Determines the link target considering 'settings.href' and data attributes
		 * but also with a fallback to the default 'href' value.
		 *
		 * @return	{string}
		 */
		_determineLinkTarget: function () {
			return (
				_self.settings.href ||
				$(_self.origin).attr(_self._prefixAttributeName("href")) ||
				$(_self.origin).attr("href")
			);
		},

		/**
		 * Determines the attribute selector to use, depending on
		 * whether categorized collections are beeing used or not.
		 *
		 * @return	{string}	selector
		 */
		_determineAttributeSelector: function () {
			var $origin = $(_self.origin),
				selector = "";

			if (typeof _self.cache.selector !== "undefined") {
				selector = _self.cache.selector;
			} else if (
				_self.settings.useCategories === true &&
				$origin.attr(_self._prefixAttributeName("categories"))
			) {
				var categories = $origin
					.attr(_self._prefixAttributeName("categories"))
					.split(" ");

				$.each(categories, function (index, category) {
					if (index > 0) {
						selector += ",";
					}
					selector +=
						"[" +
						_self._prefixAttributeName("categories") +
						'~="' +
						category +
						'"]';
				});
			} else {
				selector =
					"[" +
					_self.settings.attr +
					'="' +
					$origin.attr(_self.settings.attr) +
					'"]';
			}

			_self.cache.selector = selector;

			return selector;
		},

		/**
		 * Determines the correct resource according to the
		 * current viewport and density.
		 *
		 * @return	{string}	url
		 */
		_determineUrl: function () {
			var dataUrl = _self._verifyDataUrl(_self._determineLinkTarget()),
				width = 0,
				density = 0,
				url;

			$.each(dataUrl, function (index, src) {
				if (
					// Check density
					_self._devicePixelRatio() >= src.density &&
					src.density >= density &&
					// Check viewport width
					_self._matchMedia()(
						"screen and (min-width:" + src.width + "px)"
					).matches &&
					src.width >= width
				) {
					width = src.width;
					density = src.density;
					url = src.url;
				}
			});

			return url;
		},

		/**
		 * Normalizes an url and returns information about the resource path,
		 * the viewport width as well as density if defined.
		 *
		 * @param	{string}	url	Path to resource in format of an url or srcset
		 * @return	{object}
		 */
		_normalizeUrl: function (url) {
			var srcExp = /^\d+$/;

			return url.split(",").map(function (str) {
				var src = {
					width: 0,
					density: 0,
				};

				str.trim()
					.split(/\s+/)
					.forEach(function (url, i) {
						if (i === 0) {
							return (src.url = url);
						}

						var value = url.substring(0, url.length - 1),
							lastChar = url[url.length - 1],
							intVal = parseInt(value, 10),
							floatVal = parseFloat(value);
						if (lastChar === "w" && srcExp.test(value)) {
							src.width = intVal;
						} else if (lastChar === "h" && srcExp.test(value)) {
							src.height = intVal;
						} else if (lastChar === "x" && !isNaN(floatVal)) {
							src.density = floatVal;
						}
					});

				return src;
			});
		},

		/**
		 * Verifies if the link is part of a sequence
		 *
		 * @param	{string}	rel
		 * @param	{string}	expression
		 * @return	{boolean}
		 */
		_isPartOfSequence: function (rel, expression) {
			var getSimilarLinks = $(
					"[" + _self.settings.attr + '="' + rel + '"]'
				),
				regexp = new RegExp(expression);

			return regexp.test(rel) && getSimilarLinks.length > 1;
		},

		/**
		 * Verifies if the slideshow should be enabled
		 *
		 * @return	{boolean}
		 */
		isSlideshowEnabled: function () {
			return (
				_self.objectData.isPartOfSequence &&
				(_self.settings.slideshow === true ||
					_self.objectData.isPartOfSequenceWithSlideshow === true)
			);
		},

		/**
		 * Loads the new content to show
		 *
		 * @return	{void}
		 */
		_loadContent: function () {
			if (_self.cache.originalObject) {
				_self._restoreObject();
			}

			_self._createObject();
		},

		/**
		 * Creates a new object
		 *
		 * @return	{void}
		 */
		_createObject: function () {
			var $object;

			// Create object
			switch (_self.objectData.type) {
				case "image":
					$object = $(new Image());
					$object.attr({
						// The time expression is required to prevent the binding of an image load
						src: _self.objectData.url,
						alt: _self.objectData.title,
					});
					break;
				case "inline":
					$object = $(
						'<div class="' +
							_self.settings.classPrefix +
							'inlineWrap"></div>'
					);
					$object.html(_self._cloneObject($(_self.objectData.url)));

					// Add custom attributes from _self.settings
					$.each(_self.settings.inline, function (name, value) {
						$object.attr(_self._prefixAttributeName(name), value);
					});
					break;
				case "ajax":
					$object = $(
						'<div class="' +
							_self.settings.classPrefix +
							'inlineWrap"></div>'
					);

					// Add custom attributes from _self.settings
					$.each(_self.settings.ajax, function (name, value) {
						if (name !== "data") {
							$object.attr(
								_self._prefixAttributeName(name),
								value
							);
						}
					});
					break;
				case "flash":
					$object = $(
						'<embed src="' +
							_self.objectData.url +
							'" type="application/x-shockwave-flash"></embed>'
					);

					// Add custom attributes from _self.settings
					$.each(_self.settings.flash, function (name, value) {
						$object.attr(name, value);
					});
					break;
				case "video":
					$object = $("<video></video>");
					$object.attr("src", _self.objectData.url);

					// Add custom attributes from _self.settings
					$.each(_self.settings.video, function (name, value) {
						$object.attr(name, value);
					});
					break;
				default:
					$object = $("<iframe></iframe>");
					$object.attr({
						src: _self.objectData.url,
					});

					// Add custom attributes from _self.settings
					$.each(_self.settings.iframe, function (name, value) {
						$object.attr(name, value);
					});
					break;
			}

			_self._addObject($object);
			_self._loadObject($object);
		},

		/**
		 * Adds the new object to the markup
		 *
		 * @param	{object}	$object
		 * @return	{void}
		 */
		_addObject: function ($object) {
			// Add object to content holder
			_self.objects.contentInner.html($object);

			// Start loading
			_self._loading("start");

			// Call onStart hook functions
			_self._callHooks(_self.settings.onStart);

			// Add sequenceInfo to the content holder or hide if its empty
			if (
				_self.settings.showSequenceInfo === true &&
				_self.objectData.isPartOfSequence
			) {
				_self.objects.sequenceInfo.html(_self.objectData.sequenceInfo);
				_self.objects.sequenceInfo.show();
			} else {
				_self.objects.sequenceInfo.empty();
				_self.objects.sequenceInfo.hide();
			}
			// Add title to the content holder or hide if its empty
			if (
				_self.settings.showTitle === true &&
				_self.objectData.title !== undefined &&
				_self.objectData.title !== ""
			) {
				_self.objects.title.html(_self.objectData.title);
				_self.objects.title.show();
			} else {
				_self.objects.title.empty();
				_self.objects.title.hide();
			}
			// Add caption to the content holder or hide if its empty
			if (
				_self.settings.showCaption === true &&
				_self.objectData.caption !== undefined &&
				_self.objectData.caption !== ""
			) {
				_self.objects.caption.html(_self.objectData.caption);
				_self.objects.caption.show();
			} else {
				_self.objects.caption.empty();
				_self.objects.caption.hide();
			}
		},

		/**
		 * Loads the new object
		 *
		 * @param	{object}	$object
		 * @return	{void}
		 */
		_loadObject: function ($object) {
			// Load the object
			switch (_self.objectData.type) {
				case "inline":
					if ($(_self.objectData.url)) {
						_self._showContent($object);
					} else {
						_self.error();
					}
					break;
				case "ajax":
					$.ajax(
						$.extend({}, _self.settings.ajax, {
							url: _self.objectData.url,
							type: _self.objectData.requestType,
							dataType: _self.objectData.requestDataType,
							data: _self.objectData.requestData,
							success: function (data, textStatus, jqXHR) {
								// Unserialize if data is transferred as json
								if (
									_self.objectData.requestDataType === "json"
								) {
									_self.objectData.data = data;
								} else {
									$object.html(data);
								}
								_self._showContent($object);
							},
							error: function (jqXHR, textStatus, errorThrown) {
								_self.error();
							},
						})
					);
					break;
				case "flash":
					_self._showContent($object);
					break;
				case "video":
					if (
						typeof $object.get(0).canPlayType === "function" ||
						_self.objects.case.find("video").length === 0
					) {
						_self._showContent($object);
					} else {
						_self.error();
					}
					break;
				default:
					if (_self.objectData.url) {
						$object.on("load", function () {
							_self._showContent($object);
						});
						$object.on("error", function () {
							_self.error();
						});
					} else {
						_self.error();
					}
					break;
			}
		},

		/**
		 * Throws an error message if something went wrong
		 *
		 * @return	{void}
		 */
		error: function () {
			_self.objectData.type = "error";
			var $object = $(
				'<div class="' +
					_self.settings.classPrefix +
					'inlineWrap"></div>'
			);

			$object.html(_self.settings.errorMessage);
			_self.objects.contentInner.html($object);

			_self._showContent(_self.objects.contentInner);
		},

		/**
		 * Calculates the dimensions to fit content
		 *
		 * @param	{object}	$object
		 * @return	{void}
		 */
		_calculateDimensions: function ($object) {
			_self._cleanupDimensions();

			// Set default dimensions
			var dimensions = {
				objectWidth: $object.attr("width")
					? $object.attr("width")
					: $object.attr(_self._prefixAttributeName("width")),
				objectHeight: $object.attr("height")
					? $object.attr("height")
					: $object.attr(_self._prefixAttributeName("height")),
			};

			if (!_self.settings.disableShrink) {
				// Add calculated maximum width/height to dimensions
				dimensions.maxWidth = parseInt(
					_self.dimensions.windowWidth * _self.settings.shrinkFactor
				);
				dimensions.maxHeight = parseInt(
					_self.dimensions.windowHeight * _self.settings.shrinkFactor
				);

				// If the auto calculated maxWidth/maxHeight greather than the userdefined one, use that.
				if (dimensions.maxWidth > _self.settings.maxWidth) {
					dimensions.maxWidth = _self.settings.maxWidth;
				}
				if (dimensions.maxHeight > _self.settings.maxHeight) {
					dimensions.maxHeight = _self.settings.maxHeight;
				}

				// Calculate the difference between screen width/height and image width/height
				dimensions.differenceWidthAsPercent = parseInt(
					(100 / dimensions.maxWidth) * dimensions.objectWidth
				);
				dimensions.differenceHeightAsPercent = parseInt(
					(100 / dimensions.maxHeight) * dimensions.objectHeight
				);

				switch (_self.objectData.type) {
					case "image":
					case "flash":
					case "video":
						if (
							dimensions.differenceWidthAsPercent > 100 &&
							dimensions.differenceWidthAsPercent >
								dimensions.differenceHeightAsPercent
						) {
							dimensions.objectWidth = dimensions.maxWidth;
							dimensions.objectHeight = parseInt(
								(dimensions.objectHeight /
									dimensions.differenceWidthAsPercent) *
									100
							);
						}
						if (
							dimensions.differenceHeightAsPercent > 100 &&
							dimensions.differenceHeightAsPercent >
								dimensions.differenceWidthAsPercent
						) {
							dimensions.objectWidth = parseInt(
								(dimensions.objectWidth /
									dimensions.differenceHeightAsPercent) *
									100
							);
							dimensions.objectHeight = dimensions.maxHeight;
						}
						if (
							dimensions.differenceHeightAsPercent > 100 &&
							dimensions.differenceWidthAsPercent <
								dimensions.differenceHeightAsPercent
						) {
							dimensions.objectWidth = parseInt(
								(dimensions.maxWidth /
									dimensions.differenceHeightAsPercent) *
									dimensions.differenceWidthAsPercent
							);
							dimensions.objectHeight = dimensions.maxHeight;
						}
						break;
					case "error":
						if (
							!isNaN(dimensions.objectWidth) &&
							dimensions.objectWidth > dimensions.maxWidth
						) {
							dimensions.objectWidth = dimensions.maxWidth;
						}
						break;
					default:
						if (
							(isNaN(dimensions.objectWidth) ||
								dimensions.objectWidth > dimensions.maxWidth) &&
							!_self.settings.forceWidth
						) {
							dimensions.objectWidth = dimensions.maxWidth;
						}
						if (
							((isNaN(dimensions.objectHeight) &&
								dimensions.objectHeight !== "auto") ||
								dimensions.objectHeight >
									dimensions.maxHeight) &&
							!_self.settings.forceHeight
						) {
							dimensions.objectHeight = dimensions.maxHeight;
						}
						break;
				}
			}

			if (_self.settings.forceWidth) {
				dimensions.maxWidth = dimensions.objectWidth;
			} else if ($object.attr(_self._prefixAttributeName("max-width"))) {
				dimensions.maxWidth = $object.attr(
					_self._prefixAttributeName("max-width")
				);
			}

			if (_self.settings.forceHeight) {
				dimensions.maxHeight = dimensions.objectHeight;
			} else if ($object.attr(_self._prefixAttributeName("max-height"))) {
				dimensions.maxHeight = $object.attr(
					_self._prefixAttributeName("max-height")
				);
			}

			_self._adjustDimensions($object, dimensions);
		},

		/**
		 * Adjusts the dimensions
		 *
		 * @param	{object}	$object
		 * @param	{object}	dimensions
		 * @return	{void}
		 */
		_adjustDimensions: function ($object, dimensions) {
			// Adjust width and height
			$object.css({
				width: dimensions.objectWidth,
				height: dimensions.objectHeight,
				"max-width": dimensions.maxWidth,
				"max-height": dimensions.maxHeight,
			});

			_self.objects.contentInner.css({
				width: $object.outerWidth(),
				height: $object.outerHeight(),
				"max-width": "100%",
			});

			_self.objects.case.css({
				width: _self.objects.contentInner.outerWidth(),
			});

			// Adjust margin
			_self.objects.case.css({
				"margin-top": parseInt(-(_self.objects.case.outerHeight() / 2)),
				"margin-left": parseInt(-(_self.objects.case.outerWidth() / 2)),
			});
		},

		/**
		 * Handles the _loading
		 *
		 * @param	{string}	process
		 * @return	{void}
		 */
		_loading: function (process) {
			if (process === "start") {
				_self.objects.case.addClass(
					_self.settings.classPrefix + "loading"
				);
				_self.objects.loading.show();
			} else if (process === "end") {
				_self.objects.case.removeClass(
					_self.settings.classPrefix + "loading"
				);
				_self.objects.loading.hide();
			}
		},

		/**
		 * Gets the client screen dimensions
		 *
		 * @return	{object}	dimensions
		 */
		getViewportDimensions: function () {
			return {
				windowWidth: $(window).innerWidth(),
				windowHeight: $(window).innerHeight(),
			};
		},

		/**
		 * Verifies the url
		 *
		 * @param	{string}	dataUrl
		 * @return	{object}	dataUrl	Clean url for processing content
		 */
		_verifyDataUrl: function (dataUrl) {
			if (!dataUrl || dataUrl === undefined || dataUrl === "") {
				return false;
			}

			if (dataUrl.indexOf("#") > -1) {
				dataUrl = dataUrl.split("#");
				dataUrl = "#" + dataUrl[dataUrl.length - 1];
			}

			return _self._normalizeUrl(dataUrl.toString());
		},

		/**
		 * Verifies the data type of the content to load
		 *
		 * @param	{string}			url
		 * @return	{string|boolean}	Array key if expression matched, else false
		 */
		_verifyDataType: function (url) {
			var typeMapping = _self.settings.typeMapping;

			// Early abort if dataUrl couldn't be verified
			if (!url) {
				return false;
			}

			// Verify the dataType of url according to typeMapping which
			// has been defined in settings.
			for (var key in typeMapping) {
				if (typeMapping.hasOwnProperty(key)) {
					var suffixArr = typeMapping[key].split(",");

					for (var i = 0; i < suffixArr.length; i++) {
						var suffix = suffixArr[i].toLowerCase(),
							regexp = new RegExp(".(" + suffix + ")$", "i"),
							// Verify only the last 5 characters of the string
							str = url.toLowerCase().split("?")[0].substr(-5);

						if (
							regexp.test(str) === true ||
							(key === "inline" && url.indexOf(suffix) > -1)
						) {
							return key;
						}
					}
				}
			}

			// If no expression matched, return 'iframe'.
			return "iframe";
		},

		/**
		 * Extends html markup with the essential tags
		 *
		 * @return	{void}
		 */
		_addElements: function () {
			if (
				typeof _self.objects.case !== "undefined" &&
				$("#" + _self.objects.case.attr("id")).length
			) {
				return;
			}

			_self.settings.markup();
		},

		/**
		 * Shows the loaded content
		 *
		 * @param	{object}	$object
		 * @return	{void}
		 */
		_showContent: function ($object) {
			// Add data attribute with the object type
			_self.objects.case.attr(
				_self._prefixAttributeName("type"),
				_self.objectData.type
			);

			_self.cache.object = $object;
			_self._calculateDimensions($object);

			// Call onFinish hook functions
			_self._callHooks(_self.settings.onFinish);

			switch (_self.settings.transitionIn) {
				case "scrollTop":
				case "scrollRight":
				case "scrollBottom":
				case "scrollLeft":
				case "scrollHorizontal":
				case "scrollVertical":
					_self.transition.scroll(
						_self.objects.case,
						"in",
						_self.settings.speedIn
					);
					_self.transition.fade(
						_self.objects.contentInner,
						"in",
						_self.settings.speedIn
					);
					break;
				case "elastic":
					if (_self.objects.case.css("opacity") < 1) {
						_self.transition.zoom(
							_self.objects.case,
							"in",
							_self.settings.speedIn
						);
						_self.transition.fade(
							_self.objects.contentInner,
							"in",
							_self.settings.speedIn
						);
					}
				case "fade":
				case "fadeInline":
					_self.transition.fade(
						_self.objects.case,
						"in",
						_self.settings.speedIn
					);
					_self.transition.fade(
						_self.objects.contentInner,
						"in",
						_self.settings.speedIn
					);
					break;
				default:
					_self.transition.fade(_self.objects.case, "in", 0);
					break;
			}

			// End loading.
			_self._loading("end");
			_self.isBusy = false;
		},

		/**
		 * Processes the content to show
		 *
		 * @return	{void}
		 */
		_processContent: function () {
			_self.isBusy = true;

			switch (_self.settings.transitionOut) {
				case "scrollTop":
				case "scrollRight":
				case "scrollBottom":
				case "scrollLeft":
				case "scrollVertical":
				case "scrollHorizontal":
					if (_self.objects.case.is(":hidden")) {
						_self.transition.fade(
							_self.objects.case,
							"out",
							0,
							0,
							function () {
								_self._loadContent();
							}
						);
						_self.transition.fade(
							_self.objects.contentInner,
							"out",
							0
						);
					} else {
						_self.transition.scroll(
							_self.objects.case,
							"out",
							_self.settings.speedOut,
							function () {
								_self._loadContent();
							}
						);
					}
					break;
				case "fade":
					if (_self.objects.case.is(":hidden")) {
						_self.transition.fade(
							_self.objects.case,
							"out",
							0,
							0,
							function () {
								_self._loadContent();
							}
						);
					} else {
						_self.transition.fade(
							_self.objects.case,
							"out",
							_self.settings.speedOut,
							0,
							function () {
								_self._loadContent();
							}
						);
					}
					break;
				case "fadeInline":
				case "elastic":
					if (_self.objects.case.is(":hidden")) {
						_self.transition.fade(
							_self.objects.case,
							"out",
							0,
							0,
							function () {
								_self._loadContent();
							}
						);
					} else {
						_self.transition.fade(
							_self.objects.contentInner,
							"out",
							_self.settings.speedOut,
							0,
							function () {
								_self._loadContent();
							}
						);
					}
					break;
				default:
					_self.transition.fade(
						_self.objects.case,
						"out",
						0,
						0,
						function () {
							_self._loadContent();
						}
					);
					break;
			}
		},

		/**
		 * Handles events for gallery buttons
		 *
		 * @return	{void}
		 */
		_handleEvents: function () {
			_self._unbindEvents();

			_self.objects.nav.children().not(_self.objects.close).hide();

			// If slideshow is enabled, show play/pause and start timeout.
			if (_self.isSlideshowEnabled()) {
				// Only start the timeout if slideshow autostart is enabled and slideshow is not pausing
				if (
					(_self.settings.slideshowAutoStart === true ||
						_self.isSlideshowStarted) &&
					!_self.objects.nav.hasClass(
						_self.settings.classPrefix + "paused"
					)
				) {
					_self._startTimeout();
				} else {
					_self._stopTimeout();
				}
			}

			if (_self.settings.liveResize) {
				_self._watchResizeInteraction();
			}

			_self.objects.close.click(function (event) {
				event.preventDefault();
				_self.close();
			});

			if (_self.settings.closeOnOverlayClick === true) {
				_self.objects.overlay
					.css("cursor", "pointer")
					.click(function (event) {
						event.preventDefault();

						_self.close();
					});
			}

			if (_self.settings.useKeys === true) {
				_self._addKeyEvents();
			}

			if (_self.objectData.isPartOfSequence) {
				_self.objects.nav.attr(
					_self._prefixAttributeName("ispartofsequence"),
					true
				);
				_self.objects.nav.data("items", _self._setNavigation());

				_self.objects.prev.click(function (event) {
					event.preventDefault();

					if (
						_self.settings.navigateEndless === true ||
						!_self.item.isFirst()
					) {
						_self.objects.prev.unbind("click");
						_self.cache.action = "prev";
						_self.objects.nav.data("items").prev.click();

						if (_self.isSlideshowEnabled()) {
							_self._stopTimeout();
						}
					}
				});

				_self.objects.next.click(function (event) {
					event.preventDefault();

					if (
						_self.settings.navigateEndless === true ||
						!_self.item.isLast()
					) {
						_self.objects.next.unbind("click");
						_self.cache.action = "next";
						_self.objects.nav.data("items").next.click();

						if (_self.isSlideshowEnabled()) {
							_self._stopTimeout();
						}
					}
				});

				if (_self.isSlideshowEnabled()) {
					_self.objects.play.click(function (event) {
						event.preventDefault();
						_self._startTimeout();
					});
					_self.objects.pause.click(function (event) {
						event.preventDefault();
						_self._stopTimeout();
					});
				}

				// Enable swiping if activated
				if (_self.settings.swipe === true) {
					if ($.isPlainObject($.event.special.swipeleft)) {
						_self.objects.case.on("swipeleft", function (event) {
							event.preventDefault();
							_self.objects.next.click();
							if (_self.isSlideshowEnabled()) {
								_self._stopTimeout();
							}
						});
					}
					if ($.isPlainObject($.event.special.swiperight)) {
						_self.objects.case.on("swiperight", function (event) {
							event.preventDefault();
							_self.objects.prev.click();
							if (_self.isSlideshowEnabled()) {
								_self._stopTimeout();
							}
						});
					}
				}
			}
		},

		/**
		 * Adds the key events
		 *
		 * @return	{void}
		 */
		_addKeyEvents: function () {
			$(document).bind("keyup.lightcase", function (event) {
				// Do nothing if lightcase is in process
				if (_self.isBusy) {
					return;
				}

				switch (event.keyCode) {
					// Escape key
					case 27:
						_self.objects.close.click();
						break;
					// Backward key
					case 37:
						if (_self.objectData.isPartOfSequence) {
							_self.objects.prev.click();
						}
						break;
					// Forward key
					case 39:
						if (_self.objectData.isPartOfSequence) {
							_self.objects.next.click();
						}
						break;
				}
			});
		},

		/**
		 * Starts the slideshow timeout
		 *
		 * @return	{void}
		 */
		_startTimeout: function () {
			_self.isSlideshowStarted = true;

			_self.objects.play.hide();
			_self.objects.pause.show();

			_self.cache.action = "next";
			_self.objects.nav.removeClass(
				_self.settings.classPrefix + "paused"
			);

			_self.timeout = setTimeout(function () {
				_self.objects.nav.data("items").next.click();
			}, _self.settings.timeout);
		},

		/**
		 * Stops the slideshow timeout
		 *
		 * @return	{void}
		 */
		_stopTimeout: function () {
			_self.objects.play.show();
			_self.objects.pause.hide();

			_self.objects.nav.addClass(_self.settings.classPrefix + "paused");

			clearTimeout(_self.timeout);
		},

		/**
		 * Sets the navigator buttons (prev/next)
		 *
		 * @return	{object}	items
		 */
		_setNavigation: function () {
			var $links = $(_self.cache.selector || _self.settings.attr),
				sequenceLength = _self.objectData.sequenceLength - 1,
				items = {
					prev: $links.eq(_self.objectData.prevIndex),
					next: $links.eq(_self.objectData.nextIndex),
				};

			if (_self.objectData.currentIndex > 0) {
				_self.objects.prev.show();
			} else {
				items.prevItem = $links.eq(sequenceLength);
			}
			if (_self.objectData.nextIndex <= sequenceLength) {
				_self.objects.next.show();
			} else {
				items.next = $links.eq(0);
			}

			if (_self.settings.navigateEndless === true) {
				_self.objects.prev.show();
				_self.objects.next.show();
			}

			return items;
		},

		/**
		 * Item information/status
		 *
		 */
		item: {
			/**
			 * Verifies if the current item is first item.
			 *
			 * @return	{boolean}
			 */
			isFirst: function () {
				return _self.objectData.currentIndex === 0;
			},

			/**
			 * Verifies if the current item is last item.
			 *
			 * @return	{boolean}
			 */
			isLast: function () {
				return (
					_self.objectData.currentIndex ===
					_self.objectData.sequenceLength - 1
				);
			},
		},

		/**
		 * Clones the object for inline elements
		 *
		 * @param	{object}	$object
		 * @return	{object}	$clone
		 */
		_cloneObject: function ($object) {
			var $clone = $object.clone(),
				objectId = $object.attr("id");

			// If element is hidden, cache the object and remove
			if ($object.is(":hidden")) {
				_self._cacheObjectData($object);
				$object
					.attr("id", _self.settings.idPrefix + "temp-" + objectId)
					.empty();
			} else {
				// Prevent duplicated id's
				$clone.removeAttr("id");
			}

			return $clone.show();
		},

		/**
		 * Verifies if it is a mobile device
		 *
		 * @return	{boolean}
		 */
		isMobileDevice: function () {
			var deviceAgent = navigator.userAgent.toLowerCase(),
				agentId = deviceAgent.match(
					_self.settings.mobileMatchExpression
				);

			return agentId ? true : false;
		},

		/**
		 * Verifies if css transitions are supported
		 *
		 * @return	{string|boolean}	The transition prefix if supported, else false.
		 */
		isTransitionSupported: function () {
			var body = $("body").get(0),
				isTransitionSupported = false,
				transitionMapping = {
					transition: "",
					WebkitTransition: "-webkit-",
					MozTransition: "-moz-",
					OTransition: "-o-",
					MsTransition: "-ms-",
				};

			for (var key in transitionMapping) {
				if (
					transitionMapping.hasOwnProperty(key) &&
					key in body.style
				) {
					_self.support.transition = transitionMapping[key];
					isTransitionSupported = true;
				}
			}

			return isTransitionSupported;
		},

		/**
		 * Transition types
		 *
		 */
		transition: {
			/**
			 * Fades in/out the object
			 *
			 * @param	{object}	$object
			 * @param	{string}	type
			 * @param	{number}	speed
			 * @param	{number}	opacity
			 * @param	{function}	callback
			 * @return	{void}		Animates an object
			 */
			fade: function ($object, type, speed, opacity, callback) {
				var isInTransition = type === "in",
					startTransition = {},
					startOpacity = $object.css("opacity"),
					endTransition = {},
					endOpacity = opacity ? opacity : isInTransition ? 1 : 0;

				if (!_self.isOpen && isInTransition) return;

				startTransition["opacity"] = startOpacity;
				endTransition["opacity"] = endOpacity;

				$object.css(startTransition).show();

				// Css transition
				if (_self.support.transitions) {
					endTransition[_self.support.transition + "transition"] =
						speed + "ms ease";

					setTimeout(function () {
						$object.css(endTransition);

						setTimeout(function () {
							$object.css(
								_self.support.transition + "transition",
								""
							);

							if (callback && (_self.isOpen || !isInTransition)) {
								callback();
							}
						}, speed);
					}, 15);
				} else {
					// Fallback to js transition
					$object.stop();
					$object.animate(endTransition, speed, callback);
				}
			},

			/**
			 * Scrolls in/out the object
			 *
			 * @param	{object}	$object
			 * @param	{string}	type
			 * @param	{number}	speed
			 * @param	{function}	callback
			 * @return	{void}		Animates an object
			 */
			scroll: function ($object, type, speed, callback) {
				var isInTransition = type === "in",
					transition = isInTransition
						? _self.settings.transitionIn
						: _self.settings.transitionOut,
					direction = "left",
					startTransition = {},
					startOpacity = isInTransition ? 0 : 1,
					startOffset = isInTransition ? "-50%" : "50%",
					endTransition = {},
					endOpacity = isInTransition ? 1 : 0,
					endOffset = isInTransition ? "50%" : "-50%";

				if (!_self.isOpen && isInTransition) return;

				switch (transition) {
					case "scrollTop":
						direction = "top";
						break;
					case "scrollRight":
						startOffset = isInTransition ? "150%" : "50%";
						endOffset = isInTransition ? "50%" : "150%";
						break;
					case "scrollBottom":
						direction = "top";
						startOffset = isInTransition ? "150%" : "50%";
						endOffset = isInTransition ? "50%" : "150%";
						break;
					case "scrollHorizontal":
						startOffset = isInTransition ? "150%" : "50%";
						endOffset = isInTransition ? "50%" : "-50%";
						break;
					case "scrollVertical":
						direction = "top";
						startOffset = isInTransition ? "-50%" : "50%";
						endOffset = isInTransition ? "50%" : "150%";
						break;
				}

				if (_self.cache.action === "prev") {
					switch (transition) {
						case "scrollHorizontal":
							startOffset = isInTransition ? "-50%" : "50%";
							endOffset = isInTransition ? "50%" : "150%";
							break;
						case "scrollVertical":
							startOffset = isInTransition ? "150%" : "50%";
							endOffset = isInTransition ? "50%" : "-50%";
							break;
					}
				}

				startTransition["opacity"] = startOpacity;
				startTransition[direction] = startOffset;

				endTransition["opacity"] = endOpacity;
				endTransition[direction] = endOffset;

				$object.css(startTransition).show();

				// Css transition
				if (_self.support.transitions) {
					endTransition[_self.support.transition + "transition"] =
						speed + "ms ease";

					setTimeout(function () {
						$object.css(endTransition);

						setTimeout(function () {
							$object.css(
								_self.support.transition + "transition",
								""
							);

							if (callback && (_self.isOpen || !isInTransition)) {
								callback();
							}
						}, speed);
					}, 15);
				} else {
					// Fallback to js transition
					$object.stop();
					$object.animate(endTransition, speed, callback);
				}
			},

			/**
			 * Zooms in/out the object
			 *
			 * @param	{object}	$object
			 * @param	{string}	type
			 * @param	{number}	speed
			 * @param	{function}	callback
			 * @return	{void}		Animates an object
			 */
			zoom: function ($object, type, speed, callback) {
				var isInTransition = type === "in",
					startTransition = {},
					startOpacity = $object.css("opacity"),
					startScale = isInTransition ? "scale(0.75)" : "scale(1)",
					endTransition = {},
					endOpacity = isInTransition ? 1 : 0,
					endScale = isInTransition ? "scale(1)" : "scale(0.75)";

				if (!_self.isOpen && isInTransition) return;

				startTransition["opacity"] = startOpacity;
				startTransition[_self.support.transition + "transform"] =
					startScale;

				endTransition["opacity"] = endOpacity;

				$object.css(startTransition).show();

				// Css transition
				if (_self.support.transitions) {
					endTransition[_self.support.transition + "transform"] =
						endScale;
					endTransition[_self.support.transition + "transition"] =
						speed + "ms ease";

					setTimeout(function () {
						$object.css(endTransition);

						setTimeout(function () {
							$object.css(
								_self.support.transition + "transform",
								""
							);
							$object.css(
								_self.support.transition + "transition",
								""
							);

							if (callback && (_self.isOpen || !isInTransition)) {
								callback();
							}
						}, speed);
					}, 15);
				} else {
					// Fallback to js transition
					$object.stop();
					$object.animate(endTransition, speed, callback);
				}
			},
		},

		/**
		 * Calls all the registered functions of a specific hook
		 *
		 * @param	{object}	hooks
		 * @return	{void}
		 */
		_callHooks: function (hooks) {
			if (typeof hooks === "object") {
				$.each(hooks, function (index, hook) {
					if (typeof hook === "function") {
						hook.call(_self.origin);
					}
				});
			}
		},

		/**
		 * Caches the object data
		 *
		 * @param	{object}	$object
		 * @return	{void}
		 */
		_cacheObjectData: function ($object) {
			$.data($object, "cache", {
				id: $object.attr("id"),
				content: $object.html(),
			});

			_self.cache.originalObject = $object;
		},

		/**
		 * Restores the object from cache
		 *
		 * @return	void
		 */
		_restoreObject: function () {
			var $object = $('[id^="' + _self.settings.idPrefix + 'temp-"]');

			$object.attr("id", $.data(_self.cache.originalObject, "cache").id);
			$object.html($.data(_self.cache.originalObject, "cache").content);
		},

		/**
		 * Executes functions for a window resize.
		 * It stops an eventual timeout and recalculates dimenstions.
		 *
		 * @return	{void}
		 */
		resize: function () {
			if (!_self.isOpen) return;

			if (_self.isSlideshowEnabled()) {
				_self._stopTimeout();
			}

			_self.dimensions = _self.getViewportDimensions();
			_self._calculateDimensions(_self.cache.object);
		},

		/**
		 * Caches the actual scroll coordinates.
		 *
		 * @return	{void}
		 */
		_cacheScrollPosition: function () {
			var $window = $(window),
				$document = $(document),
				offset = {
					top: $window.scrollTop(),
					left: $window.scrollLeft(),
				};

			_self.cache.scrollPosition = _self.cache.scrollPosition || {};

			if (!_self._assertContentInvisible()) {
				_self.cache.cacheScrollPositionSkipped = true;
			} else if (_self.cache.cacheScrollPositionSkipped) {
				delete _self.cache.cacheScrollPositionSkipped;
				_self._restoreScrollPosition();
			} else {
				if ($document.width() > $window.width()) {
					_self.cache.scrollPosition.left = offset.left;
				}
				if ($document.height() > $window.height()) {
					_self.cache.scrollPosition.top = offset.top;
				}
			}
		},

		/**
		 * Watches for any resize interaction and caches the new sizes.
		 *
		 * @return	{void}
		 */
		_watchResizeInteraction: function () {
			$(window).resize(_self.resize);
		},

		/**
		 * Stop watching any resize interaction related to _self.
		 *
		 * @return	{void}
		 */
		_unwatchResizeInteraction: function () {
			$(window).off("resize", _self.resize);
		},

		/**
		 * Watches for any scroll interaction and caches the new position.
		 *
		 * @return	{void}
		 */
		_watchScrollInteraction: function () {
			$(window).scroll(_self._cacheScrollPosition);
			$(window).resize(_self._cacheScrollPosition);
		},

		/**
		 * Stop watching any scroll interaction related to _self.
		 *
		 * @return	{void}
		 */
		_unwatchScrollInteraction: function () {
			$(window).off("scroll", _self._cacheScrollPosition);
			$(window).off("resize", _self._cacheScrollPosition);
		},

		/**
		 * Ensures that site content is invisible or has not height.
		 *
		 * @return	{boolean}
		 */
		_assertContentInvisible: function () {
			return (
				$(
					$("body")
						.children()
						.not("[id*=" + _self.settings.idPrefix + "]")
						.get(0)
				).height() > 0
			);
		},

		/**
		 * Restores to the original scoll position before
		 * lightcase got initialized.
		 *
		 * @return	{void}
		 */
		_restoreScrollPosition: function () {
			$(window)
				.scrollTop(parseInt(_self.cache.scrollPosition.top))
				.scrollLeft(parseInt(_self.cache.scrollPosition.left))
				.resize();
		},

		/**
		 * Switches to the fullscreen mode
		 *
		 * @return	{void}
		 */
		_switchToFullScreenMode: function () {
			_self.settings.shrinkFactor = 1;
			_self.settings.overlayOpacity = 1;

			$("html").addClass(_self.settings.classPrefix + "fullScreenMode");
		},

		/**
		 * Enters into the lightcase view
		 *
		 * @return	{void}
		 */
		_open: function () {
			_self.isOpen = true;

			_self.support.transitions = _self.settings.cssTransitions
				? _self.isTransitionSupported()
				: false;
			_self.support.mobileDevice = _self.isMobileDevice();

			if (_self.support.mobileDevice) {
				$("html").addClass(
					_self.settings.classPrefix + "isMobileDevice"
				);

				if (_self.settings.fullScreenModeForMobile) {
					_self._switchToFullScreenMode();
				}
			}
			if (!_self.settings.transitionIn) {
				_self.settings.transitionIn = _self.settings.transition;
			}
			if (!_self.settings.transitionOut) {
				_self.settings.transitionOut = _self.settings.transition;
			}

			switch (_self.settings.transitionIn) {
				case "fade":
				case "fadeInline":
				case "elastic":
				case "scrollTop":
				case "scrollRight":
				case "scrollBottom":
				case "scrollLeft":
				case "scrollVertical":
				case "scrollHorizontal":
					if (_self.objects.case.is(":hidden")) {
						_self.objects.close.css("opacity", 0);
						_self.objects.overlay.css("opacity", 0);
						_self.objects.case.css("opacity", 0);
						_self.objects.contentInner.css("opacity", 0);
					}
					_self.transition.fade(
						_self.objects.overlay,
						"in",
						_self.settings.speedIn,
						_self.settings.overlayOpacity,
						function () {
							_self.transition.fade(
								_self.objects.close,
								"in",
								_self.settings.speedIn
							);
							_self._handleEvents();
							_self._processContent();
						}
					);
					break;
				default:
					_self.transition.fade(
						_self.objects.overlay,
						"in",
						0,
						_self.settings.overlayOpacity,
						function () {
							_self.transition.fade(_self.objects.close, "in", 0);
							_self._handleEvents();
							_self._processContent();
						}
					);
					break;
			}

			$("html").addClass(_self.settings.classPrefix + "open");
			_self.objects.case.attr("aria-hidden", "false");
		},

		/**
		 * Escapes from the lightcase view
		 *
		 * @return	{void}
		 */
		close: function () {
			_self.isOpen = false;

			if (_self.isSlideshowEnabled()) {
				_self._stopTimeout();
				_self.isSlideshowStarted = false;
				_self.objects.nav.removeClass(
					_self.settings.classPrefix + "paused"
				);
			}

			_self.objects.loading.hide();

			_self._unbindEvents();

			_self._unwatchResizeInteraction();
			_self._unwatchScrollInteraction();

			$("html").removeClass(_self.settings.classPrefix + "open");
			_self.objects.case.attr("aria-hidden", "true");

			_self.objects.nav.children().hide();

			_self._restoreScrollPosition();

			// Call onClose hook functions
			_self._callHooks(_self.settings.onClose);

			switch (_self.settings.transitionOut) {
				case "fade":
				case "fadeInline":
				case "scrollTop":
				case "scrollRight":
				case "scrollBottom":
				case "scrollLeft":
				case "scrollHorizontal":
				case "scrollVertical":
					_self.transition.fade(
						_self.objects.case,
						"out",
						_self.settings.speedOut,
						0,
						function () {
							_self.transition.fade(
								_self.objects.overlay,
								"out",
								_self.settings.speedOut,
								0,
								function () {
									_self.cleanup();
								}
							);
						}
					);
					break;
				case "elastic":
					_self.transition.zoom(
						_self.objects.case,
						"out",
						_self.settings.speedOut,
						function () {
							_self.transition.fade(
								_self.objects.overlay,
								"out",
								_self.settings.speedOut,
								0,
								function () {
									_self.cleanup();
								}
							);
						}
					);
					break;
				default:
					_self.cleanup();
					break;
			}
		},

		/**
		 * Unbinds all given events
		 *
		 * @return	{void}
		 */
		_unbindEvents: function () {
			// Unbind overlay event
			_self.objects.overlay.unbind("click");

			// Unbind key events
			$(document).unbind("keyup.revlightcase");

			// Unbind swipe events
			_self.objects.case.unbind("swipeleft").unbind("swiperight");

			// Unbind navigator events
			_self.objects.prev.unbind("click");
			_self.objects.next.unbind("click");
			_self.objects.play.unbind("click");
			_self.objects.pause.unbind("click");

			// Unbind close event
			_self.objects.close.unbind("click");
		},

		/**
		 * Cleans up the dimensions
		 *
		 * @return	{void}
		 */
		_cleanupDimensions: function () {
			var opacity = _self.objects.contentInner.css("opacity");

			_self.objects.case.css({
				width: "",
				height: "",
				top: "",
				left: "",
				"margin-top": "",
				"margin-left": "",
			});

			_self.objects.contentInner
				.removeAttr("style")
				.css("opacity", opacity);
			_self.objects.contentInner.children().removeAttr("style");
		},

		/**
		 * Cleanup after aborting lightcase
		 *
		 * @return	{void}
		 */
		cleanup: function () {
			_self._cleanupDimensions();

			_self.objects.loading.hide();
			_self.objects.overlay.hide();
			_self.objects.case.hide();
			_self.objects.prev.hide();
			_self.objects.next.hide();
			_self.objects.play.hide();
			_self.objects.pause.hide();

			_self.objects.case.removeAttr(_self._prefixAttributeName("type"));
			_self.objects.nav.removeAttr(
				_self._prefixAttributeName("ispartofsequence")
			);

			_self.objects.contentInner.empty().hide();
			_self.objects.info.children().empty();

			if (_self.cache.originalObject) {
				_self._restoreObject();
			}

			// Call onCleanup hook functions
			_self._callHooks(_self.settings.onCleanup);

			// Restore cache
			_self.cache = {};
		},

		/**
		 * Returns the supported match media or undefined if the browser
		 * doesn't support match media.
		 *
		 * @return	{mixed}
		 */
		_matchMedia: function () {
			return window.matchMedia || window.msMatchMedia;
		},

		/**
		 * Returns the devicePixelRatio if supported. Else, it simply returns
		 * 1 as the default.
		 *
		 * @return	{number}
		 */
		_devicePixelRatio: function () {
			return window.devicePixelRatio || 1;
		},

		/**
		 * Checks if method is public
		 *
		 * @return	{boolean}
		 */
		_isPublicMethod: function (method) {
			return (
				typeof _self[method] === "function" && method.charAt(0) !== "_"
			);
		},

		/**
		 * Exports all public methods to be accessible, callable
		 * from global scope.
		 *
		 * @return	{void}
		 */
		_export: function () {
			window.revlightcase = {};

			$.each(_self, function (property) {
				if (_self._isPublicMethod(property)) {
					revlightcase[property] = _self[property];
				}
			});
		},
	};

	_self._export();

	$.fn.revlightcase = function (method) {
		// Method calling logic (only public methods are applied)
		if (_self._isPublicMethod(method)) {
			return _self[method].apply(
				this,
				Array.prototype.slice.call(arguments, 1)
			);
		} else if (typeof method === "object" || !method) {
			return _self.init.apply(this, arguments);
		} else {
			$.error(
				"Method " + method + " does not exist on jQuery.revlightcase"
			);
		}
	};
})(jQuery);

/*!
 * jScroll - jQuery Plugin for Infinite Scrolling / Auto-Paging - v2.2.4
 * http://jscroll.com/
 *
 * Copyright 2011-2013, Philip Klauzinski
 * http://klauzinski.com/
 * Dual licensed under the MIT and GPL Version 2 licenses.
 * http://jscroll.com/#license
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @author Philip Klauzinski
 * @requires jQuery v1.4.3+
 */
(function ($) {
	// Define the jscroll namespace and default settings
	$.jscroll = {
		defaults: {
			debug: false,
			autoTrigger: true,
			autoTriggerUntil: false,
			loadingHtml: "<small>Loading...</small>",
			padding: 0,
			nextSelector: "a:last",
			contentSelector: "",
			pagingSelector: "",
			callback: false,
		},
	};

	// Constructor
	var jScroll = function ($e, options) {
		// Private vars
		var _data = $e.data("jscroll"),
			_userOptions =
				typeof options === "function"
					? {
							callback: options,
					  }
					: options,
			_options = $.extend(
				{},
				$.jscroll.defaults,
				_userOptions,
				_data || {}
			),
			_isWindow = $e.css("overflow-y") === "visible",
			_$next = $e.find(_options.nextSelector).first(),
			_$window = $(window),
			_$body = $("body"),
			_$scroll = _isWindow ? _$window : $e,
			_nextHref = $.trim(
				_$next.attr("href") + " " + _options.contentSelector
			);

		// Initialization
		$e.data(
			"jscroll",
			$.extend({}, _data, {
				initialized: true,
				waiting: false,
				nextHref: _nextHref,
			})
		);
		_wrapInnerContent();
		_preloadImage();
		_setBindings();

		// Private methods

		// Check if a loading image is defined and preload
		function _preloadImage() {
			var src = $(_options.loadingHtml).filter("img").attr("src");
			if (src) {
				var image = new Image();
				image.src = src;
			}
		}

		// Wrapper inner content, if it isn't already
		function _wrapInnerContent() {
			if (!$e.find(".jscroll-inner").length) {
				$e.contents().wrapAll('<div class="jscroll-inner" />');
			}
		}

		// Find the next link's parent, or add one, and hide it
		function _nextWrap($next) {
			if (_options.pagingSelector) {
				var $parent = $next.closest(_options.pagingSelector).hide();
			} else {
				var $parent = $next
					.parent()
					.not(".jscroll-inner,.jscroll-added")
					.addClass("jscroll-next-parent")
					.hide();
				if (!$parent.length) {
					$next
						.wrap('<div class="jscroll-next-parent" />')
						.parent()
						.hide();
				}
			}
		}

		// Remove the jscroll behavior and data from an element
		function _destroy() {
			return _$scroll
				.unbind(".jscroll")
				.removeData("jscroll")
				.find(".jscroll-inner")
				.children()
				.unwrap()
				.filter(".jscroll-added")
				.children()
				.unwrap();
		}

		// Observe the scroll event for when to trigger the next load
		function _observe() {
			_wrapInnerContent();
			var $inner = $e.find("div.jscroll-inner").first(),
				data = $e.data("jscroll"),
				borderTopWidth = parseInt($e.css("borderTopWidth")),
				borderTopWidthInt = isNaN(borderTopWidth) ? 0 : borderTopWidth,
				iContainerTop =
					parseInt($e.css("paddingTop")) + borderTopWidthInt,
				iTopHeight = _isWindow ? _$scroll.scrollTop() : $e.offset().top,
				innerTop = $inner.length ? $inner.offset().top : 0,
				iTotalHeight = Math.ceil(
					iTopHeight - innerTop + _$scroll.height() + iContainerTop
				);

			if (
				!data.waiting &&
				iTotalHeight + _options.padding >= $inner.outerHeight()
			) {
				//data.nextHref = $.trim(data.nextHref + ' ' + _options.contentSelector);
				_debug(
					"info",
					"jScroll:",
					$inner.outerHeight() - iTotalHeight,
					"from bottom. Loading next request..."
				);
				return _load();
			}
		}

		// Check if the href for the next set of content has been set
		function _checkNextHref(data) {
			data = data || $e.data("jscroll");
			if (!data || !data.nextHref) {
				_debug("warn", "jScroll: nextSelector not found - destroying");
				_destroy();
				return false;
			} else {
				_setBindings();
				return true;
			}
		}

		function _setBindings() {
			var $next = $e.find(_options.nextSelector).first();
			if (
				_options.autoTrigger &&
				(_options.autoTriggerUntil === false ||
					_options.autoTriggerUntil > 0)
			) {
				_nextWrap($next);
				if (_$body.height() <= _$window.height()) {
					_observe();
				}
				_$scroll.unbind(".jscroll").bind("scroll.jscroll", function () {
					return _observe();
				});
				if (_options.autoTriggerUntil > 0) {
					_options.autoTriggerUntil--;
				}
			} else {
				_$scroll.unbind(".jscroll");
				$next.bind("click.jscroll", function () {
					_nextWrap($next);
					_load();
					return false;
				});
			}
		}

		// Load the next set of content, if available
		function _load() {
			var $inner = $e.find("div.jscroll-inner").first(),
				data = $e.data("jscroll");

			data.waiting = true;
			$inner
				.append('<div class="jscroll-added" />')
				.children(".jscroll-added")
				.last()
				.html(
					'<div class="jscroll-loading">' +
						_options.loadingHtml +
						"</div>"
				);

			return $e.animate(
				{
					scrollTop: $inner.outerHeight(),
				},
				0,
				function () {
					$inner
						.find("div.jscroll-added")
						.last()
						.load(data.nextHref, function (r, status, xhr) {
							if (status === "error") {
								return _destroy();
							}
							var $next = $(this)
								.find(_options.nextSelector)
								.first();
							data.waiting = false;
							data.nextHref = $next.attr("href")
								? $.trim(
										$next.attr("href") +
											" " +
											_options.contentSelector
								  )
								: false;
							$(".jscroll-next-parent", $e).remove(); // Remove the previous next link now that we have a new one
							_checkNextHref();
							if (_options.callback) {
								_options.callback.call(this);
							}
							_debug("dir", data);
						});
				}
			);
		}

		// Safe console debug - http://klauzinski.com/javascript/safe-firebug-console-in-javascript
		function _debug(m) {
			if (
				_options.debug &&
				typeof console === "object" &&
				(typeof m === "object" || typeof console[m] === "function")
			) {
				if (typeof m === "object") {
					var args = [];
					for (var sMethod in m) {
						if (typeof console[sMethod] === "function") {
							args = m[sMethod].length
								? m[sMethod]
								: [m[sMethod]];
							console[sMethod].apply(console, args);
						} else {
							console.log.apply(console, args);
						}
					}
				} else {
					console[m].apply(
						console,
						Array.prototype.slice.call(arguments, 1)
					);
				}
			}
		}

		// Expose API methods via the jQuery.jscroll namespace, e.g. $('sel').jscroll.method()
		$.extend($e.jscroll, {
			destroy: _destroy,
		});
		return $e;
	};

	// Define the jscroll plugin method and loop
	$.fn.jscroll = function (m) {
		return this.each(function () {
			var $this = $(this),
				data = $this.data("jscroll");
			// Instantiate jScroll on this element if it hasn't been already
			if (data && data.initialized) return;
			var jscroll = new jScroll($this, m);
		});
	};
})(jQuery);

/*
     _ _      _       _
 ___| (_) ___| | __  (_)___
/ __| | |/ __| |/ /  | / __|
\__ \ | | (__|   < _ | \__ \
|___/_|_|\___|_|\_(_)/ |___/
                   |__/

 Version: 1.8.0
  Author: Ken Wheeler
 Website: http://kenwheeler.github.io
    Docs: http://kenwheeler.github.io/revSlick
    Repo: http://github.com/kenwheeler/revSlick
  Issues: http://github.com/kenwheeler/revSlick/issues

 */
/* global window, document, define, jQuery, setInterval, clearInterval */
(function (factory) {
	"use strict";
	if (typeof define === "function" && define.amd) {
		define(["jquery"], factory);
	} else if (typeof exports !== "undefined") {
		module.exports = factory(require("jquery"));
	} else {
		factory(jQuery);
	}
})(function ($) {
	"use strict";
	var revSlick = window.revSlick || {};

	revSlick = (function () {
		var instanceUid = 0;

		function revSlick(element, settings) {
			var _ = this,
				dataSettings;

			_.defaults = {
				accessibility: true,
				adaptiveHeight: false,
				appendArrows: $(element),
				appendDots: $(element),
				arrows: true,
				asNavFor: null,
				prevArrow:
					'<button class="revSlick-prev" aria-label="Previous" type="button">Previous</button>',
				nextArrow:
					'<button class="revSlick-next" aria-label="Next" type="button">Next</button>',
				autoplay: false,
				autoplaySpeed: 3000,
				centerMode: false,
				centerPadding: "50px",
				cssEase: "ease",
				customPaging: function (slider, i) {
					return $('<button type="button" />').text(i + 1);
				},
				dots: false,
				dotsClass: "revSlick-dots",
				draggable: true,
				easing: "linear",
				edgeFriction: 0.35,
				fade: false,
				focusOnSelect: false,
				focusOnChange: false,
				infinite: true,
				initialSlide: 0,
				lazyLoad: "ondemand",
				mobileFirst: false,
				pauseOnHover: true,
				pauseOnFocus: true,
				pauseOnDotsHover: false,
				respondTo: "window",
				responsive: null,
				rows: 1,
				rtl: false,
				slide: "",
				slidesPerRow: 1,
				slidesToShow: 1,
				slidesToScroll: 1,
				speed: 500,
				swipe: true,
				swipeToSlide: false,
				touchMove: true,
				touchThreshold: 5,
				useCSS: true,
				useTransform: true,
				variableWidth: false,
				vertical: false,
				verticalSwiping: false,
				waitForAnimate: true,
				zIndex: 1000,
			};

			_.initials = {
				animating: false,
				dragging: false,
				autoPlayTimer: null,
				currentDirection: 0,
				currentLeft: null,
				currentSlide: 0,
				direction: 1,
				$dots: null,
				listWidth: null,
				listHeight: null,
				loadIndex: 0,
				$nextArrow: null,
				$prevArrow: null,
				scrolling: false,
				slideCount: null,
				slideWidth: null,
				$slideTrack: null,
				$slides: null,
				sliding: false,
				slideOffset: 0,
				swipeLeft: null,
				swiping: false,
				$list: null,
				touchObject: {},
				transformsEnabled: false,
				unrevSlicked: false,
			};

			$.extend(_, _.initials);

			_.activeBreakpoint = null;
			_.animType = null;
			_.animProp = null;
			_.breakpoints = [];
			_.breakpointSettings = [];
			_.cssTransitions = false;
			_.focussed = false;
			_.interrupted = false;
			_.hidden = "hidden";
			_.paused = true;
			_.positionProp = null;
			_.respondTo = null;
			_.rowCount = 1;
			_.shouldClick = true;
			_.$slider = $(element);
			_.$slidesCache = null;
			_.transformType = null;
			_.transitionType = null;
			_.visibilityChange = "visibilitychange";
			_.windowWidth = 0;
			_.windowTimer = null;

			dataSettings = $(element).data("revSlick") || {};

			_.options = $.extend({}, _.defaults, settings, dataSettings);

			_.currentSlide = _.options.initialSlide;

			_.originalSettings = _.options;

			if (typeof document.mozHidden !== "undefined") {
				_.hidden = "mozHidden";
				_.visibilityChange = "mozvisibilitychange";
			} else if (typeof document.webkitHidden !== "undefined") {
				_.hidden = "webkitHidden";
				_.visibilityChange = "webkitvisibilitychange";
			}

			_.autoPlay = $.proxy(_.autoPlay, _);
			_.autoPlayClear = $.proxy(_.autoPlayClear, _);
			_.autoPlayIterator = $.proxy(_.autoPlayIterator, _);
			_.changeSlide = $.proxy(_.changeSlide, _);
			_.clickHandler = $.proxy(_.clickHandler, _);
			_.selectHandler = $.proxy(_.selectHandler, _);
			_.setPosition = $.proxy(_.setPosition, _);
			_.swipeHandler = $.proxy(_.swipeHandler, _);
			_.dragHandler = $.proxy(_.dragHandler, _);
			_.keyHandler = $.proxy(_.keyHandler, _);

			_.instanceUid = instanceUid++;

			// A simple way to check for HTML strings
			// Strict HTML recognition (must start with <)
			// Extracted from jQuery v1.11 source
			_.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/;

			_.registerBreakpoints();
			_.init(true);
		}

		return revSlick;
	})();

	revSlick.prototype.activateADA = function () {
		var _ = this;

		_.$slideTrack
			.find(".revSlick-active")
			.attr({
				"aria-hidden": "false",
			})
			.find("a, input, button, select")
			.attr({
				tabindex: "0",
			});
	};

	revSlick.prototype.addSlide = revSlick.prototype.revSlickAdd = function (
		markup,
		index,
		addBefore
	) {
		var _ = this;

		if (typeof index === "boolean") {
			addBefore = index;
			index = null;
		} else if (index < 0 || index >= _.slideCount) {
			return false;
		}

		_.unload();

		if (typeof index === "number") {
			if (index === 0 && _.$slides.length === 0) {
				$(markup).appendTo(_.$slideTrack);
			} else if (addBefore) {
				$(markup).insertBefore(_.$slides.eq(index));
			} else {
				$(markup).insertAfter(_.$slides.eq(index));
			}
		} else {
			if (addBefore === true) {
				$(markup).prependTo(_.$slideTrack);
			} else {
				$(markup).appendTo(_.$slideTrack);
			}
		}

		_.$slides = _.$slideTrack.children(this.options.slide);

		_.$slideTrack.children(this.options.slide).detach();

		_.$slideTrack.append(_.$slides);

		_.$slides.each(function (index, element) {
			$(element).attr("data-revSlick-index", index);
		});

		_.$slidesCache = _.$slides;

		_.reinit();
	};

	revSlick.prototype.animateHeight = function () {
		var _ = this;
		if (
			_.options.slidesToShow === 1 &&
			_.options.adaptiveHeight === true &&
			_.options.vertical === false
		) {
			var targetHeight = _.$slides.eq(_.currentSlide).outerHeight(true);
			_.$list.animate(
				{
					height: targetHeight,
				},
				_.options.speed
			);
		}
	};

	revSlick.prototype.animateSlide = function (targetLeft, callback) {
		var animProps = {},
			_ = this;

		_.animateHeight();

		if (_.options.rtl === true && _.options.vertical === false) {
			targetLeft = -targetLeft;
		}
		if (_.transformsEnabled === false) {
			if (_.options.vertical === false) {
				_.$slideTrack.animate(
					{
						left: targetLeft,
					},
					_.options.speed,
					_.options.easing,
					callback
				);
			} else {
				_.$slideTrack.animate(
					{
						top: targetLeft,
					},
					_.options.speed,
					_.options.easing,
					callback
				);
			}
		} else {
			if (_.cssTransitions === false) {
				if (_.options.rtl === true) {
					_.currentLeft = -_.currentLeft;
				}
				$({
					animStart: _.currentLeft,
				}).animate(
					{
						animStart: targetLeft,
					},
					{
						duration: _.options.speed,
						easing: _.options.easing,
						step: function (now) {
							now = Math.ceil(now);
							if (_.options.vertical === false) {
								animProps[_.animType] =
									"translate(" + now + "px, 0px)";
								_.$slideTrack.css(animProps);
							} else {
								animProps[_.animType] =
									"translate(0px," + now + "px)";
								_.$slideTrack.css(animProps);
							}
						},
						complete: function () {
							if (callback) {
								callback.call();
							}
						},
					}
				);
			} else {
				_.applyTransition();
				targetLeft = Math.ceil(targetLeft);

				if (_.options.vertical === false) {
					animProps[_.animType] =
						"translate3d(" + targetLeft + "px, 0px, 0px)";
				} else {
					animProps[_.animType] =
						"translate3d(0px," + targetLeft + "px, 0px)";
				}
				_.$slideTrack.css(animProps);

				if (callback) {
					setTimeout(function () {
						_.disableTransition();

						callback.call();
					}, _.options.speed);
				}
			}
		}
	};

	revSlick.prototype.getNavTarget = function () {
		var _ = this,
			asNavFor = _.options.asNavFor;

		if (asNavFor && asNavFor !== null) {
			asNavFor = $(asNavFor).not(_.$slider);
		}

		return asNavFor;
	};

	revSlick.prototype.asNavFor = function (index) {
		var _ = this,
			asNavFor = _.getNavTarget();

		if (asNavFor !== null && typeof asNavFor === "object") {
			asNavFor.each(function () {
				var target = $(this).revSlick("getrevSlick");
				if (!target.unrevSlicked) {
					target.slideHandler(index, true);
				}
			});
		}
	};

	revSlick.prototype.applyTransition = function (slide) {
		var _ = this,
			transition = {};

		if (_.options.fade === false) {
			transition[_.transitionType] =
				_.transformType +
				" " +
				_.options.speed +
				"ms " +
				_.options.cssEase;
		} else {
			transition[_.transitionType] =
				"opacity " + _.options.speed + "ms " + _.options.cssEase;
		}

		if (_.options.fade === false) {
			_.$slideTrack.css(transition);
		} else {
			_.$slides.eq(slide).css(transition);
		}
	};

	revSlick.prototype.autoPlay = function () {
		var _ = this;

		_.autoPlayClear();

		if (_.slideCount > _.options.slidesToShow) {
			_.autoPlayTimer = setInterval(
				_.autoPlayIterator,
				_.options.autoplaySpeed
			);
		}
	};

	revSlick.prototype.autoPlayClear = function () {
		var _ = this;

		if (_.autoPlayTimer) {
			clearInterval(_.autoPlayTimer);
		}
	};

	revSlick.prototype.autoPlayIterator = function () {
		var _ = this,
			slideTo = _.currentSlide + _.options.slidesToScroll;

		if (!_.paused && !_.interrupted && !_.focussed) {
			if (_.options.infinite === false) {
				if (
					_.direction === 1 &&
					_.currentSlide + 1 === _.slideCount - 1
				) {
					_.direction = 0;
				} else if (_.direction === 0) {
					slideTo = _.currentSlide - _.options.slidesToScroll;

					if (_.currentSlide - 1 === 0) {
						_.direction = 1;
					}
				}
			}

			_.slideHandler(slideTo);
		}
	};

	revSlick.prototype.buildArrows = function () {
		var _ = this;

		if (_.options.arrows === true) {
			_.$prevArrow = $(_.options.prevArrow).addClass("revSlick-arrow");
			_.$nextArrow = $(_.options.nextArrow).addClass("revSlick-arrow");

			if (_.slideCount > _.options.slidesToShow) {
				_.$prevArrow
					.removeClass("revSlick-hidden")
					.removeAttr("aria-hidden tabindex");
				_.$nextArrow
					.removeClass("revSlick-hidden")
					.removeAttr("aria-hidden tabindex");

				if (_.htmlExpr.test(_.options.prevArrow)) {
					_.$prevArrow.prependTo(_.options.appendArrows);
				}

				if (_.htmlExpr.test(_.options.nextArrow)) {
					_.$nextArrow.appendTo(_.options.appendArrows);
				}

				if (_.options.infinite !== true) {
					_.$prevArrow
						.addClass("revSlick-disabled")
						.attr("aria-disabled", "true");
				}
			} else {
				_.$prevArrow
					.add(_.$nextArrow)

					.addClass("revSlick-hidden")
					.attr({
						"aria-disabled": "true",
						tabindex: "-1",
					});
			}
		}
	};

	revSlick.prototype.buildDots = function () {
		var _ = this,
			i,
			dot;

		if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {
			_.$slider.addClass("revSlick-dotted");

			dot = $("<ul />").addClass(_.options.dotsClass);

			for (i = 0; i <= _.getDotCount(); i += 1) {
				dot.append(
					$("<li />").append(_.options.customPaging.call(this, _, i))
				);
			}

			_.$dots = dot.appendTo(_.options.appendDots);

			_.$dots.find("li").first().addClass("revSlick-active");
		}
	};

	revSlick.prototype.buildOut = function () {
		var _ = this;

		_.$slides = _.$slider
			.children(_.options.slide + ":not(.revSlick-cloned)")
			.addClass("revSlick-slide");

		_.slideCount = _.$slides.length;

		_.$slides.each(function (index, element) {
			$(element)
				.attr("data-revSlick-index", index)
				.data("originalStyling", $(element).attr("style") || "");
		});

		_.$slider.addClass("revSlick-slider");

		_.$slideTrack =
			_.slideCount === 0
				? $('<div class="revSlick-track"/>').appendTo(_.$slider)
				: _.$slides.wrapAll('<div class="revSlick-track"/>').parent();

		_.$list = _.$slideTrack.wrap('<div class="revSlick-list"/>').parent();
		_.$slideTrack.css("opacity", 0);

		if (_.options.centerMode === true || _.options.swipeToSlide === true) {
			_.options.slidesToScroll = 1;
		}

		$("img[data-lazy]", _.$slider)
			.not("[src]")
			.addClass("revSlick-loading");

		_.setupInfinite();

		_.buildArrows();

		_.buildDots();

		_.updateDots();

		_.setSlideClasses(
			typeof _.currentSlide === "number" ? _.currentSlide : 0
		);

		if (_.options.draggable === true) {
			_.$list.addClass("draggable");
		}
	};

	revSlick.prototype.buildRows = function () {
		var _ = this,
			a,
			b,
			c,
			newSlides,
			numOfSlides,
			originalSlides,
			slidesPerSection;

		newSlides = document.createDocumentFragment();
		originalSlides = _.$slider.children();

		if (_.options.rows > 0) {
			slidesPerSection = _.options.slidesPerRow * _.options.rows;
			numOfSlides = Math.ceil(originalSlides.length / slidesPerSection);

			for (a = 0; a < numOfSlides; a++) {
				var slide = document.createElement("div");
				for (b = 0; b < _.options.rows; b++) {
					var row = document.createElement("div");
					for (c = 0; c < _.options.slidesPerRow; c++) {
						var target =
							a * slidesPerSection +
							(b * _.options.slidesPerRow + c);
						if (originalSlides.get(target)) {
							row.appendChild(originalSlides.get(target));
						}
					}
					slide.appendChild(row);
				}
				newSlides.appendChild(slide);
			}

			_.$slider.empty().append(newSlides);
			_.$slider
				.children()
				.children()
				.children()
				.css({
					width: 100 / _.options.slidesPerRow + "%",
					display: "inline-block",
				});
		}
	};

	revSlick.prototype.checkResponsive = function (initial, forceUpdate) {
		var _ = this,
			breakpoint,
			targetBreakpoint,
			respondToWidth,
			triggerBreakpoint = false;
		var sliderWidth = _.$slider.width();
		var windowWidth = window.innerWidth || $(window).width();

		if (_.respondTo === "window") {
			respondToWidth = windowWidth;
		} else if (_.respondTo === "slider") {
			respondToWidth = sliderWidth;
		} else if (_.respondTo === "min") {
			respondToWidth = Math.min(windowWidth, sliderWidth);
		}

		if (
			_.options.responsive &&
			_.options.responsive.length &&
			_.options.responsive !== null
		) {
			targetBreakpoint = null;

			for (breakpoint in _.breakpoints) {
				if (_.breakpoints.hasOwnProperty(breakpoint)) {
					if (_.originalSettings.mobileFirst === false) {
						if (respondToWidth < _.breakpoints[breakpoint]) {
							targetBreakpoint = _.breakpoints[breakpoint];
						}
					} else {
						if (respondToWidth > _.breakpoints[breakpoint]) {
							targetBreakpoint = _.breakpoints[breakpoint];
						}
					}
				}
			}

			if (targetBreakpoint !== null) {
				if (_.activeBreakpoint !== null) {
					if (
						targetBreakpoint !== _.activeBreakpoint ||
						forceUpdate
					) {
						_.activeBreakpoint = targetBreakpoint;
						if (
							_.breakpointSettings[targetBreakpoint] ===
							"unrevSlick"
						) {
							_.unrevSlick(targetBreakpoint);
						} else {
							_.options = $.extend(
								{},
								_.originalSettings,
								_.breakpointSettings[targetBreakpoint]
							);
							if (initial === true) {
								_.currentSlide = _.options.initialSlide;
							}
							_.refresh(initial);
						}
						triggerBreakpoint = targetBreakpoint;
					}
				} else {
					_.activeBreakpoint = targetBreakpoint;
					if (
						_.breakpointSettings[targetBreakpoint] === "unrevSlick"
					) {
						_.unrevSlick(targetBreakpoint);
					} else {
						_.options = $.extend(
							{},
							_.originalSettings,
							_.breakpointSettings[targetBreakpoint]
						);
						if (initial === true) {
							_.currentSlide = _.options.initialSlide;
						}
						_.refresh(initial);
					}
					triggerBreakpoint = targetBreakpoint;
				}
			} else {
				if (_.activeBreakpoint !== null) {
					_.activeBreakpoint = null;
					_.options = _.originalSettings;
					if (initial === true) {
						_.currentSlide = _.options.initialSlide;
					}
					_.refresh(initial);
					triggerBreakpoint = targetBreakpoint;
				}
			}

			// only trigger breakpoints during an actual break. not on initialize.
			if (!initial && triggerBreakpoint !== false) {
				_.$slider.trigger("breakpoint", [_, triggerBreakpoint]);
			}
		}
	};

	revSlick.prototype.changeSlide = function (event, dontAnimate) {
		var _ = this,
			$target = $(event.currentTarget),
			indexOffset,
			slideOffset,
			unevenOffset;

		// If target is a link, prevent default action.
		if ($target.is("a")) {
			event.preventDefault();
		}

		// If target is not the <li> element (ie: a child), find the <li>.
		if (!$target.is("li")) {
			$target = $target.closest("li");
		}

		unevenOffset = _.slideCount % _.options.slidesToScroll !== 0;
		indexOffset = unevenOffset
			? 0
			: (_.slideCount - _.currentSlide) % _.options.slidesToScroll;

		switch (event.data.message) {
			case "previous":
				slideOffset =
					indexOffset === 0
						? _.options.slidesToScroll
						: _.options.slidesToShow - indexOffset;
				if (_.slideCount > _.options.slidesToShow) {
					_.slideHandler(
						_.currentSlide - slideOffset,
						false,
						dontAnimate
					);
				}
				break;

			case "next":
				slideOffset =
					indexOffset === 0 ? _.options.slidesToScroll : indexOffset;
				if (_.slideCount > _.options.slidesToShow) {
					_.slideHandler(
						_.currentSlide + slideOffset,
						false,
						dontAnimate
					);
				}
				break;

			case "index":
				var index =
					event.data.index === 0
						? 0
						: event.data.index ||
						  $target.index() * _.options.slidesToScroll;

				_.slideHandler(_.checkNavigable(index), false, dontAnimate);
				$target.children().trigger("focus");
				break;

			default:
				return;
		}
	};

	revSlick.prototype.checkNavigable = function (index) {
		var _ = this,
			navigables,
			prevNavigable;

		navigables = _.getNavigableIndexes();
		prevNavigable = 0;
		if (index > navigables[navigables.length - 1]) {
			index = navigables[navigables.length - 1];
		} else {
			for (var n in navigables) {
				if (index < navigables[n]) {
					index = prevNavigable;
					break;
				}
				prevNavigable = navigables[n];
			}
		}

		return index;
	};

	revSlick.prototype.cleanUpEvents = function () {
		var _ = this;

		if (_.options.dots && _.$dots !== null) {
			$("li", _.$dots)
				.off("click.revSlick", _.changeSlide)
				.off("mouseenter.revSlick", $.proxy(_.interrupt, _, true))
				.off("mouseleave.revSlick", $.proxy(_.interrupt, _, false));

			if (_.options.accessibility === true) {
				_.$dots.off("keydown.revSlick", _.keyHandler);
			}
		}

		_.$slider.off("focus.revSlick blur.revSlick");

		if (
			_.options.arrows === true &&
			_.slideCount > _.options.slidesToShow
		) {
			_.$prevArrow && _.$prevArrow.off("click.revSlick", _.changeSlide);
			_.$nextArrow && _.$nextArrow.off("click.revSlick", _.changeSlide);

			if (_.options.accessibility === true) {
				_.$prevArrow &&
					_.$prevArrow.off("keydown.revSlick", _.keyHandler);
				_.$nextArrow &&
					_.$nextArrow.off("keydown.revSlick", _.keyHandler);
			}
		}

		_.$list.off("touchstart.revSlick mousedown.revSlick", _.swipeHandler);
		_.$list.off("touchmove.revSlick mousemove.revSlick", _.swipeHandler);
		_.$list.off("touchend.revSlick mouseup.revSlick", _.swipeHandler);
		_.$list.off("touchcancel.revSlick mouseleave.revSlick", _.swipeHandler);

		_.$list.off("click.revSlick", _.clickHandler);

		$(document).off(_.visibilityChange, _.visibility);

		_.cleanUpSlideEvents();

		if (_.options.accessibility === true) {
			_.$list.off("keydown.revSlick", _.keyHandler);
		}

		if (_.options.focusOnSelect === true) {
			$(_.$slideTrack).children().off("click.revSlick", _.selectHandler);
		}

		$(window).off(
			"orientationchange.revSlick.revSlick-" + _.instanceUid,
			_.orientationChange
		);

		$(window).off("resize.revSlick.revSlick-" + _.instanceUid, _.resize);

		$("[draggable!=true]", _.$slideTrack).off(
			"dragstart",
			_.preventDefault
		);

		$(window).off("load.revSlick.revSlick-" + _.instanceUid, _.setPosition);
	};

	revSlick.prototype.cleanUpSlideEvents = function () {
		var _ = this;

		_.$list.off("mouseenter.revSlick", $.proxy(_.interrupt, _, true));
		_.$list.off("mouseleave.revSlick", $.proxy(_.interrupt, _, false));
	};

	revSlick.prototype.cleanUpRows = function () {
		var _ = this,
			originalSlides;

		if (_.options.rows > 0) {
			originalSlides = _.$slides.children().children();
			originalSlides.removeAttr("style");
			_.$slider.empty().append(originalSlides);
		}
	};

	revSlick.prototype.clickHandler = function (event) {
		var _ = this;

		if (_.shouldClick === false) {
			event.stopImmediatePropagation();
			event.stopPropagation();
			event.preventDefault();
		}
	};

	revSlick.prototype.destroy = function (refresh) {
		var _ = this;

		_.autoPlayClear();

		_.touchObject = {};

		_.cleanUpEvents();

		$(".revSlick-cloned", _.$slider).detach();

		if (_.$dots) {
			_.$dots.remove();
		}

		if (_.$prevArrow && _.$prevArrow.length) {
			_.$prevArrow
				.removeClass("revSlick-disabled revSlick-arrow revSlick-hidden")
				.removeAttr("aria-hidden aria-disabled tabindex")
				.css("display", "");

			if (_.htmlExpr.test(_.options.prevArrow)) {
				_.$prevArrow.remove();
			}
		}

		if (_.$nextArrow && _.$nextArrow.length) {
			_.$nextArrow
				.removeClass("revSlick-disabled revSlick-arrow revSlick-hidden")
				.removeAttr("aria-hidden aria-disabled tabindex")
				.css("display", "");

			if (_.htmlExpr.test(_.options.nextArrow)) {
				_.$nextArrow.remove();
			}
		}

		if (_.$slides) {
			_.$slides
				.removeClass(
					"revSlick-slide revSlick-active revSlick-center revSlick-visible revSlick-current"
				)
				.removeAttr("aria-hidden")
				.removeAttr("data-revSlick-index")
				.each(function () {
					$(this).attr("style", $(this).data("originalStyling"));
				});

			_.$slideTrack.children(this.options.slide).detach();

			_.$slideTrack.detach();

			_.$list.detach();

			_.$slider.append(_.$slides);
		}

		_.cleanUpRows();

		_.$slider.removeClass("revSlick-slider");
		_.$slider.removeClass("revSlick-initialized");
		_.$slider.removeClass("revSlick-dotted");

		_.unrevSlicked = true;

		if (!refresh) {
			_.$slider.trigger("destroy", [_]);
		}
	};

	revSlick.prototype.disableTransition = function (slide) {
		var _ = this,
			transition = {};

		transition[_.transitionType] = "";

		if (_.options.fade === false) {
			_.$slideTrack.css(transition);
		} else {
			_.$slides.eq(slide).css(transition);
		}
	};

	revSlick.prototype.fadeSlide = function (slideIndex, callback) {
		var _ = this;

		if (_.cssTransitions === false) {
			_.$slides.eq(slideIndex).css({
				zIndex: _.options.zIndex,
			});

			_.$slides.eq(slideIndex).animate(
				{
					opacity: 1,
				},
				_.options.speed,
				_.options.easing,
				callback
			);
		} else {
			_.applyTransition(slideIndex);

			_.$slides.eq(slideIndex).css({
				opacity: 1,
				zIndex: _.options.zIndex,
			});

			if (callback) {
				setTimeout(function () {
					_.disableTransition(slideIndex);

					callback.call();
				}, _.options.speed);
			}
		}
	};

	revSlick.prototype.fadeSlideOut = function (slideIndex) {
		var _ = this;

		if (_.cssTransitions === false) {
			_.$slides.eq(slideIndex).animate(
				{
					opacity: 0,
					zIndex: _.options.zIndex - 2,
				},
				_.options.speed,
				_.options.easing
			);
		} else {
			_.applyTransition(slideIndex);

			_.$slides.eq(slideIndex).css({
				opacity: 0,
				zIndex: _.options.zIndex - 2,
			});
		}
	};

	revSlick.prototype.filterSlides = revSlick.prototype.revSlickFilter =
		function (filter) {
			var _ = this;

			if (filter !== null) {
				_.$slidesCache = _.$slides;

				_.unload();

				_.$slideTrack.children(this.options.slide).detach();

				_.$slidesCache.filter(filter).appendTo(_.$slideTrack);

				_.reinit();
			}
		};

	revSlick.prototype.focusHandler = function () {
		var _ = this;

		_.$slider
			.off("focus.revSlick blur.revSlick")
			.on("focus.revSlick blur.revSlick", "*", function (event) {
				event.stopImmediatePropagation();
				var $sf = $(this);

				setTimeout(function () {
					if (_.options.pauseOnFocus) {
						_.focussed = $sf.is(":focus");
						_.autoPlay();
					}
				}, 0);
			});
	};

	revSlick.prototype.getCurrent = revSlick.prototype.revSlickCurrentSlide =
		function () {
			var _ = this;
			return _.currentSlide;
		};

	revSlick.prototype.getDotCount = function () {
		var _ = this;

		var breakPoint = 0;
		var counter = 0;
		var pagerQty = 0;

		if (_.options.infinite === true) {
			if (_.slideCount <= _.options.slidesToShow) {
				++pagerQty;
			} else {
				while (breakPoint < _.slideCount) {
					++pagerQty;
					breakPoint = counter + _.options.slidesToScroll;
					counter +=
						_.options.slidesToScroll <= _.options.slidesToShow
							? _.options.slidesToScroll
							: _.options.slidesToShow;
				}
			}
		} else if (_.options.centerMode === true) {
			pagerQty = _.slideCount;
		} else if (!_.options.asNavFor) {
			pagerQty =
				1 +
				Math.ceil(
					(_.slideCount - _.options.slidesToShow) /
						_.options.slidesToScroll
				);
		} else {
			while (breakPoint < _.slideCount) {
				++pagerQty;
				breakPoint = counter + _.options.slidesToScroll;
				counter +=
					_.options.slidesToScroll <= _.options.slidesToShow
						? _.options.slidesToScroll
						: _.options.slidesToShow;
			}
		}

		return pagerQty - 1;
	};

	revSlick.prototype.getLeft = function (slideIndex) {
		var _ = this,
			targetLeft,
			verticalHeight,
			verticalOffset = 0,
			targetSlide,
			coef;

		_.slideOffset = 0;
		verticalHeight = _.$slides.first().outerHeight(true);

		if (_.options.infinite === true) {
			if (_.slideCount > _.options.slidesToShow) {
				_.slideOffset = _.slideWidth * _.options.slidesToShow * -1;
				coef = -1;

				if (
					_.options.vertical === true &&
					_.options.centerMode === true
				) {
					if (_.options.slidesToShow === 2) {
						coef = -1.5;
					} else if (_.options.slidesToShow === 1) {
						coef = -2;
					}
				}
				verticalOffset = verticalHeight * _.options.slidesToShow * coef;
			}
			if (_.slideCount % _.options.slidesToScroll !== 0) {
				if (
					slideIndex + _.options.slidesToScroll > _.slideCount &&
					_.slideCount > _.options.slidesToShow
				) {
					if (slideIndex > _.slideCount) {
						_.slideOffset =
							(_.options.slidesToShow -
								(slideIndex - _.slideCount)) *
							_.slideWidth *
							-1;
						verticalOffset =
							(_.options.slidesToShow -
								(slideIndex - _.slideCount)) *
							verticalHeight *
							-1;
					} else {
						_.slideOffset =
							(_.slideCount % _.options.slidesToScroll) *
							_.slideWidth *
							-1;
						verticalOffset =
							(_.slideCount % _.options.slidesToScroll) *
							verticalHeight *
							-1;
					}
				}
			}
		} else {
			if (slideIndex + _.options.slidesToShow > _.slideCount) {
				_.slideOffset =
					(slideIndex + _.options.slidesToShow - _.slideCount) *
					_.slideWidth;
				verticalOffset =
					(slideIndex + _.options.slidesToShow - _.slideCount) *
					verticalHeight;
			}
		}

		if (_.slideCount <= _.options.slidesToShow) {
			_.slideOffset = 0;
			verticalOffset = 0;
		}

		if (
			_.options.centerMode === true &&
			_.slideCount <= _.options.slidesToShow
		) {
			_.slideOffset =
				(_.slideWidth * Math.floor(_.options.slidesToShow)) / 2 -
				(_.slideWidth * _.slideCount) / 2;
		} else if (
			_.options.centerMode === true &&
			_.options.infinite === true
		) {
			_.slideOffset +=
				_.slideWidth * Math.floor(_.options.slidesToShow / 2) -
				_.slideWidth;
		} else if (_.options.centerMode === true) {
			_.slideOffset = 0;
			_.slideOffset +=
				_.slideWidth * Math.floor(_.options.slidesToShow / 2);
		}

		if (_.options.vertical === false) {
			targetLeft = slideIndex * _.slideWidth * -1 + _.slideOffset;
		} else {
			targetLeft = slideIndex * verticalHeight * -1 + verticalOffset;
		}

		if (_.options.variableWidth === true) {
			if (
				_.slideCount <= _.options.slidesToShow ||
				_.options.infinite === false
			) {
				targetSlide = _.$slideTrack
					.children(".revSlick-slide")
					.eq(slideIndex);
			} else {
				targetSlide = _.$slideTrack
					.children(".revSlick-slide")
					.eq(slideIndex + _.options.slidesToShow);
			}

			if (_.options.rtl === true) {
				if (targetSlide[0]) {
					targetLeft =
						(_.$slideTrack.width() -
							targetSlide[0].offsetLeft -
							targetSlide.width()) *
						-1;
				} else {
					targetLeft = 0;
				}
			} else {
				targetLeft = targetSlide[0]
					? targetSlide[0].offsetLeft * -1
					: 0;
			}

			if (_.options.centerMode === true) {
				if (
					_.slideCount <= _.options.slidesToShow ||
					_.options.infinite === false
				) {
					targetSlide = _.$slideTrack
						.children(".revSlick-slide")
						.eq(slideIndex);
				} else {
					targetSlide = _.$slideTrack
						.children(".revSlick-slide")
						.eq(slideIndex + _.options.slidesToShow + 1);
				}

				if (_.options.rtl === true) {
					if (targetSlide[0]) {
						targetLeft =
							(_.$slideTrack.width() -
								targetSlide[0].offsetLeft -
								targetSlide.width()) *
							-1;
					} else {
						targetLeft = 0;
					}
				} else {
					targetLeft = targetSlide[0]
						? targetSlide[0].offsetLeft * -1
						: 0;
				}

				targetLeft += (_.$list.width() - targetSlide.outerWidth()) / 2;
			}
		}

		return targetLeft;
	};

	revSlick.prototype.getOption = revSlick.prototype.revSlickGetOption =
		function (option) {
			var _ = this;

			return _.options[option];
		};

	revSlick.prototype.getNavigableIndexes = function () {
		var _ = this,
			breakPoint = 0,
			counter = 0,
			indexes = [],
			max;

		if (_.options.infinite === false) {
			max = _.slideCount;
		} else {
			breakPoint = _.options.slidesToScroll * -1;
			counter = _.options.slidesToScroll * -1;
			max = _.slideCount * 2;
		}

		while (breakPoint < max) {
			indexes.push(breakPoint);
			breakPoint = counter + _.options.slidesToScroll;
			counter +=
				_.options.slidesToScroll <= _.options.slidesToShow
					? _.options.slidesToScroll
					: _.options.slidesToShow;
		}

		return indexes;
	};

	revSlick.prototype.getrevSlick = function () {
		return this;
	};

	revSlick.prototype.getSlideCount = function () {
		var _ = this,
			slidesTraversed,
			swipedSlide,
			centerOffset;

		centerOffset =
			_.options.centerMode === true
				? _.slideWidth * Math.floor(_.options.slidesToShow / 2)
				: 0;

		if (_.options.swipeToSlide === true) {
			_.$slideTrack.find(".revSlick-slide").each(function (index, slide) {
				if (
					slide.offsetLeft -
						centerOffset +
						$(slide).outerWidth() / 2 >
					_.swipeLeft * -1
				) {
					swipedSlide = slide;
					return false;
				}
			});

			slidesTraversed =
				Math.abs(
					$(swipedSlide).attr("data-revSlick-index") - _.currentSlide
				) || 1;

			return slidesTraversed;
		} else {
			return _.options.slidesToScroll;
		}
	};

	revSlick.prototype.goTo = revSlick.prototype.revSlickGoTo = function (
		slide,
		dontAnimate
	) {
		var _ = this;

		_.changeSlide(
			{
				data: {
					message: "index",
					index: parseInt(slide),
				},
			},
			dontAnimate
		);
	};

	revSlick.prototype.init = function (creation) {
		var _ = this;

		if (!$(_.$slider).hasClass("revSlick-initialized")) {
			$(_.$slider).addClass("revSlick-initialized");

			_.buildRows();
			_.buildOut();
			_.setProps();
			_.startLoad();
			_.loadSlider();
			_.initializeEvents();
			_.updateArrows();
			_.updateDots();
			_.checkResponsive(true);
			_.focusHandler();
		}

		if (creation) {
			_.$slider.trigger("init", [_]);
		}

		if (_.options.accessibility === true) {
			_.initADA();
		}

		if (_.options.autoplay) {
			_.paused = false;
			_.autoPlay();
		}
	};

	revSlick.prototype.initADA = function () {
		var _ = this,
			numDotGroups = Math.ceil(_.slideCount / _.options.slidesToShow),
			tabControlIndexes = _.getNavigableIndexes().filter(function (val) {
				return val >= 0 && val < _.slideCount;
			});

		_.$slides
			.add(_.$slideTrack.find(".revSlick-cloned"))
			.attr({
				"aria-hidden": "true",
				tabindex: "-1",
			})
			.find("a, input, button, select")
			.attr({
				tabindex: "-1",
			});

		if (_.$dots !== null) {
			_.$slides
				.not(_.$slideTrack.find(".revSlick-cloned"))
				.each(function (i) {
					var slideControlIndex = tabControlIndexes.indexOf(i);

					$(this).attr({
						role: "tabpanel",
						id: "revSlick-slide" + _.instanceUid + i,
						tabindex: -1,
					});

					if (slideControlIndex !== -1) {
						var ariaButtonControl =
							"revSlick-slide-control" +
							_.instanceUid +
							slideControlIndex;
						if ($("#" + ariaButtonControl).length) {
							$(this).attr({
								"aria-describedby": ariaButtonControl,
							});
						}
					}
				});

			_.$dots
				.attr("role", "tablist")
				.find("li")
				.each(function (i) {
					var mappedSlideIndex = tabControlIndexes[i];

					$(this).attr({
						role: "presentation",
					});

					$(this)
						.find("button")
						.first()
						.attr({
							role: "tab",
							id: "revSlick-slide-control" + _.instanceUid + i,
							"aria-controls":
								"revSlick-slide" +
								_.instanceUid +
								mappedSlideIndex,
							"aria-label": i + 1 + " of " + numDotGroups,
							"aria-selected": null,
							tabindex: "-1",
						});
				})
				.eq(_.currentSlide)
				.find("button")
				.attr({
					"aria-selected": "true",
					tabindex: "0",
				})
				.end();
		}

		for (
			var i = _.currentSlide, max = i + _.options.slidesToShow;
			i < max;
			i++
		) {
			if (_.options.focusOnChange) {
				_.$slides.eq(i).attr({
					tabindex: "0",
				});
			} else {
				_.$slides.eq(i).removeAttr("tabindex");
			}
		}

		_.activateADA();
	};

	revSlick.prototype.initArrowEvents = function () {
		var _ = this;

		if (
			_.options.arrows === true &&
			_.slideCount > _.options.slidesToShow
		) {
			_.$prevArrow.off("click.revSlick").on(
				"click.revSlick",
				{
					message: "previous",
				},
				_.changeSlide
			);
			_.$nextArrow.off("click.revSlick").on(
				"click.revSlick",
				{
					message: "next",
				},
				_.changeSlide
			);

			if (_.options.accessibility === true) {
				_.$prevArrow.on("keydown.revSlick", _.keyHandler);
				_.$nextArrow.on("keydown.revSlick", _.keyHandler);
			}
		}
	};

	revSlick.prototype.initDotEvents = function () {
		var _ = this;

		if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {
			$("li", _.$dots).on(
				"click.revSlick",
				{
					message: "index",
				},
				_.changeSlide
			);

			if (_.options.accessibility === true) {
				_.$dots.on("keydown.revSlick", _.keyHandler);
			}
		}

		if (
			_.options.dots === true &&
			_.options.pauseOnDotsHover === true &&
			_.slideCount > _.options.slidesToShow
		) {
			$("li", _.$dots)
				.on("mouseenter.revSlick", $.proxy(_.interrupt, _, true))
				.on("mouseleave.revSlick", $.proxy(_.interrupt, _, false));
		}
	};

	revSlick.prototype.initSlideEvents = function () {
		var _ = this;

		if (_.options.pauseOnHover) {
			_.$list.on("mouseenter.revSlick", $.proxy(_.interrupt, _, true));
			_.$list.on("mouseleave.revSlick", $.proxy(_.interrupt, _, false));
		}
	};

	revSlick.prototype.initializeEvents = function () {
		var _ = this;

		_.initArrowEvents();

		_.initDotEvents();
		_.initSlideEvents();

		_.$list.on(
			"touchstart.revSlick mousedown.revSlick",
			{
				action: "start",
			},
			_.swipeHandler
		);
		_.$list.on(
			"touchmove.revSlick mousemove.revSlick",
			{
				action: "move",
			},
			_.swipeHandler
		);
		_.$list.on(
			"touchend.revSlick mouseup.revSlick",
			{
				action: "end",
			},
			_.swipeHandler
		);
		_.$list.on(
			"touchcancel.revSlick mouseleave.revSlick",
			{
				action: "end",
			},
			_.swipeHandler
		);

		_.$list.on("click.revSlick", _.clickHandler);

		$(document).on(_.visibilityChange, $.proxy(_.visibility, _));

		if (_.options.accessibility === true) {
			_.$list.on("keydown.revSlick", _.keyHandler);
		}

		if (_.options.focusOnSelect === true) {
			$(_.$slideTrack).children().on("click.revSlick", _.selectHandler);
		}

		$(window).on(
			"orientationchange.revSlick.revSlick-" + _.instanceUid,
			$.proxy(_.orientationChange, _)
		);

		$(window).on(
			"resize.revSlick.revSlick-" + _.instanceUid,
			$.proxy(_.resize, _)
		);

		$("[draggable!=true]", _.$slideTrack).on("dragstart", _.preventDefault);

		$(window).on("load.revSlick.revSlick-" + _.instanceUid, _.setPosition);
		$(_.setPosition);
	};

	revSlick.prototype.initUI = function () {
		var _ = this;

		if (
			_.options.arrows === true &&
			_.slideCount > _.options.slidesToShow
		) {
			_.$prevArrow.show();
			_.$nextArrow.show();
		}

		if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {
			_.$dots.show();
		}
	};

	revSlick.prototype.keyHandler = function (event) {
		var _ = this;
		//Dont slide if the cursor is inside the form fields and arrow keys are pressed
		if (!event.target.tagName.match("TEXTAREA|INPUT|SELECT")) {
			if (event.keyCode === 37 && _.options.accessibility === true) {
				_.changeSlide({
					data: {
						message: _.options.rtl === true ? "next" : "previous",
					},
				});
			} else if (
				event.keyCode === 39 &&
				_.options.accessibility === true
			) {
				_.changeSlide({
					data: {
						message: _.options.rtl === true ? "previous" : "next",
					},
				});
			}
		}
	};

	revSlick.prototype.lazyLoad = function () {
		var _ = this,
			loadRange,
			cloneRange,
			rangeStart,
			rangeEnd;

		function loadImages(imagesScope) {
			$("img[data-lazy]", imagesScope).each(function () {
				var image = $(this),
					imageSource = $(this).attr("data-lazy"),
					imageSrcSet = $(this).attr("data-srcset"),
					imageSizes =
						$(this).attr("data-sizes") ||
						_.$slider.attr("data-sizes"),
					imageToLoad = document.createElement("img");

				imageToLoad.onload = function () {
					image.animate(
						{
							opacity: 0,
						},
						100,
						function () {
							if (imageSrcSet) {
								image.attr("srcset", imageSrcSet);

								if (imageSizes) {
									image.attr("sizes", imageSizes);
								}
							}

							image.attr("src", imageSource).animate(
								{
									opacity: 1,
								},
								200,
								function () {
									image
										.removeAttr(
											"data-lazy data-srcset data-sizes"
										)
										.removeClass("revSlick-loading");
								}
							);
							_.$slider.trigger("lazyLoaded", [
								_,
								image,
								imageSource,
							]);
						}
					);
				};

				imageToLoad.onerror = function () {
					image
						.removeAttr("data-lazy")
						.removeClass("revSlick-loading")
						.addClass("revSlick-lazyload-error");

					_.$slider.trigger("lazyLoadError", [_, image, imageSource]);
				};

				imageToLoad.src = imageSource;
			});
		}

		if (_.options.centerMode === true) {
			if (_.options.infinite === true) {
				rangeStart = _.currentSlide + (_.options.slidesToShow / 2 + 1);
				rangeEnd = rangeStart + _.options.slidesToShow + 2;
			} else {
				rangeStart = Math.max(
					0,
					_.currentSlide - (_.options.slidesToShow / 2 + 1)
				);
				rangeEnd =
					2 + (_.options.slidesToShow / 2 + 1) + _.currentSlide;
			}
		} else {
			rangeStart = _.options.infinite
				? _.options.slidesToShow + _.currentSlide
				: _.currentSlide;
			rangeEnd = Math.ceil(rangeStart + _.options.slidesToShow);
			if (_.options.fade === true) {
				if (rangeStart > 0) rangeStart--;
				if (rangeEnd <= _.slideCount) rangeEnd++;
			}
		}

		loadRange = _.$slider
			.find(".revSlick-slide")
			.slice(rangeStart, rangeEnd);

		if (_.options.lazyLoad === "anticipated") {
			var prevSlide = rangeStart - 1,
				nextSlide = rangeEnd,
				$slides = _.$slider.find(".revSlick-slide");

			for (var i = 0; i < _.options.slidesToScroll; i++) {
				if (prevSlide < 0) prevSlide = _.slideCount - 1;
				loadRange = loadRange.add($slides.eq(prevSlide));
				loadRange = loadRange.add($slides.eq(nextSlide));
				prevSlide--;
				nextSlide++;
			}
		}

		loadImages(loadRange);

		if (_.slideCount <= _.options.slidesToShow) {
			cloneRange = _.$slider.find(".revSlick-slide");
			loadImages(cloneRange);
		} else if (_.currentSlide >= _.slideCount - _.options.slidesToShow) {
			cloneRange = _.$slider
				.find(".revSlick-cloned")
				.slice(0, _.options.slidesToShow);
			loadImages(cloneRange);
		} else if (_.currentSlide === 0) {
			cloneRange = _.$slider
				.find(".revSlick-cloned")
				.slice(_.options.slidesToShow * -1);
			loadImages(cloneRange);
		}
	};

	revSlick.prototype.loadSlider = function () {
		var _ = this;

		_.setPosition();

		_.$slideTrack.css({
			opacity: 1,
		});

		_.$slider.removeClass("revSlick-loading");

		_.initUI();

		if (_.options.lazyLoad === "progressive") {
			_.progressiveLazyLoad();
		}
	};

	revSlick.prototype.next = revSlick.prototype.revSlickNext = function () {
		var _ = this;

		_.changeSlide({
			data: {
				message: "next",
			},
		});
	};

	revSlick.prototype.orientationChange = function () {
		var _ = this;

		_.checkResponsive();
		_.setPosition();
	};

	revSlick.prototype.pause = revSlick.prototype.revSlickPause = function () {
		var _ = this;

		_.autoPlayClear();
		_.paused = true;
	};

	revSlick.prototype.play = revSlick.prototype.revSlickPlay = function () {
		var _ = this;

		_.autoPlay();
		_.options.autoplay = true;
		_.paused = false;
		_.focussed = false;
		_.interrupted = false;
	};

	revSlick.prototype.postSlide = function (index) {
		var _ = this;

		if (!_.unrevSlicked) {
			_.$slider.trigger("afterChange", [_, index]);

			_.animating = false;

			if (_.slideCount > _.options.slidesToShow) {
				_.setPosition();
			}

			_.swipeLeft = null;

			if (_.options.autoplay) {
				_.autoPlay();
			}

			if (_.options.accessibility === true) {
				_.initADA();

				if (_.options.focusOnChange) {
					var $currentSlide = $(_.$slides.get(_.currentSlide));
					$currentSlide.attr("tabindex", 0).focus();
				}
			}
		}
	};

	revSlick.prototype.prev = revSlick.prototype.revSlickPrev = function () {
		var _ = this;

		_.changeSlide({
			data: {
				message: "previous",
			},
		});
	};

	revSlick.prototype.preventDefault = function (event) {
		event.preventDefault();
	};

	revSlick.prototype.progressiveLazyLoad = function (tryCount) {
		tryCount = tryCount || 1;

		var _ = this,
			$imgsToLoad = $("img[data-lazy]", _.$slider),
			image,
			imageSource,
			imageSrcSet,
			imageSizes,
			imageToLoad;

		if ($imgsToLoad.length) {
			image = $imgsToLoad.first();
			imageSource = image.attr("data-lazy");
			imageSrcSet = image.attr("data-srcset");
			imageSizes =
				image.attr("data-sizes") || _.$slider.attr("data-sizes");
			imageToLoad = document.createElement("img");

			imageToLoad.onload = function () {
				if (imageSrcSet) {
					image.attr("srcset", imageSrcSet);

					if (imageSizes) {
						image.attr("sizes", imageSizes);
					}
				}

				image
					.attr("src", imageSource)
					.removeAttr("data-lazy data-srcset data-sizes")
					.removeClass("revSlick-loading");

				if (_.options.adaptiveHeight === true) {
					_.setPosition();
				}

				_.$slider.trigger("lazyLoaded", [_, image, imageSource]);
				_.progressiveLazyLoad();
			};

			imageToLoad.onerror = function () {
				if (tryCount < 3) {
					/**
					 * try to load the image 3 times,
					 * leave a slight delay so we don't get
					 * servers blocking the request.
					 */
					setTimeout(function () {
						_.progressiveLazyLoad(tryCount + 1);
					}, 500);
				} else {
					image
						.removeAttr("data-lazy")
						.removeClass("revSlick-loading")
						.addClass("revSlick-lazyload-error");

					_.$slider.trigger("lazyLoadError", [_, image, imageSource]);

					_.progressiveLazyLoad();
				}
			};

			imageToLoad.src = imageSource;
		} else {
			_.$slider.trigger("allImagesLoaded", [_]);
		}
	};

	revSlick.prototype.refresh = function (initializing) {
		var _ = this,
			currentSlide,
			lastVisibleIndex;

		lastVisibleIndex = _.slideCount - _.options.slidesToShow;

		// in non-infinite sliders, we don't want to go past the
		// last visible index.
		if (!_.options.infinite && _.currentSlide > lastVisibleIndex) {
			_.currentSlide = lastVisibleIndex;
		}

		// if less slides than to show, go to start.
		if (_.slideCount <= _.options.slidesToShow) {
			_.currentSlide = 0;
		}

		currentSlide = _.currentSlide;

		_.destroy(true);

		$.extend(_, _.initials, {
			currentSlide: currentSlide,
		});

		_.init();

		if (!initializing) {
			_.changeSlide(
				{
					data: {
						message: "index",
						index: currentSlide,
					},
				},
				false
			);
		}
	};

	revSlick.prototype.registerBreakpoints = function () {
		var _ = this,
			breakpoint,
			currentBreakpoint,
			l,
			responsiveSettings = _.options.responsive || null;

		if (
			$.type(responsiveSettings) === "array" &&
			responsiveSettings.length
		) {
			_.respondTo = _.options.respondTo || "window";

			for (breakpoint in responsiveSettings) {
				l = _.breakpoints.length - 1;

				if (responsiveSettings.hasOwnProperty(breakpoint)) {
					currentBreakpoint =
						responsiveSettings[breakpoint].breakpoint;

					// loop through the breakpoints and cut out any existing
					// ones with the same breakpoint number, we don't want dupes.
					while (l >= 0) {
						if (
							_.breakpoints[l] &&
							_.breakpoints[l] === currentBreakpoint
						) {
							_.breakpoints.splice(l, 1);
						}
						l--;
					}

					_.breakpoints.push(currentBreakpoint);
					_.breakpointSettings[currentBreakpoint] =
						responsiveSettings[breakpoint].settings;
				}
			}

			_.breakpoints.sort(function (a, b) {
				return _.options.mobileFirst ? a - b : b - a;
			});
		}
	};

	revSlick.prototype.reinit = function () {
		var _ = this;

		_.$slides = _.$slideTrack
			.children(_.options.slide)
			.addClass("revSlick-slide");

		_.slideCount = _.$slides.length;

		if (_.currentSlide >= _.slideCount && _.currentSlide !== 0) {
			_.currentSlide = _.currentSlide - _.options.slidesToScroll;
		}

		if (_.slideCount <= _.options.slidesToShow) {
			_.currentSlide = 0;
		}

		_.registerBreakpoints();

		_.setProps();
		_.setupInfinite();
		_.buildArrows();
		_.updateArrows();
		_.initArrowEvents();
		_.buildDots();
		_.updateDots();
		_.initDotEvents();
		_.cleanUpSlideEvents();
		_.initSlideEvents();

		_.checkResponsive(false, true);

		if (_.options.focusOnSelect === true) {
			$(_.$slideTrack).children().on("click.revSlick", _.selectHandler);
		}

		_.setSlideClasses(
			typeof _.currentSlide === "number" ? _.currentSlide : 0
		);

		_.setPosition();
		_.focusHandler();

		_.paused = !_.options.autoplay;
		_.autoPlay();

		_.$slider.trigger("reInit", [_]);
	};

	revSlick.prototype.resize = function () {
		var _ = this;

		if ($(window).width() !== _.windowWidth) {
			clearTimeout(_.windowDelay);
			_.windowDelay = window.setTimeout(function () {
				_.windowWidth = $(window).width();
				_.checkResponsive();
				if (!_.unrevSlicked) {
					_.setPosition();
				}
			}, 50);
		}
	};

	revSlick.prototype.removeSlide = revSlick.prototype.revSlickRemove =
		function (index, removeBefore, removeAll) {
			var _ = this;

			if (typeof index === "boolean") {
				removeBefore = index;
				index = removeBefore === true ? 0 : _.slideCount - 1;
			} else {
				index = removeBefore === true ? --index : index;
			}

			if (_.slideCount < 1 || index < 0 || index > _.slideCount - 1) {
				return false;
			}

			_.unload();

			if (removeAll === true) {
				_.$slideTrack.children().remove();
			} else {
				_.$slideTrack.children(this.options.slide).eq(index).remove();
			}

			_.$slides = _.$slideTrack.children(this.options.slide);

			_.$slideTrack.children(this.options.slide).detach();

			_.$slideTrack.append(_.$slides);

			_.$slidesCache = _.$slides;

			_.reinit();
		};

	revSlick.prototype.setCSS = function (position) {
		var _ = this,
			positionProps = {},
			x,
			y;

		if (_.options.rtl === true) {
			position = -position;
		}
		x = _.positionProp == "left" ? Math.ceil(position) + "px" : "0px";
		y = _.positionProp == "top" ? Math.ceil(position) + "px" : "0px";

		positionProps[_.positionProp] = position;

		if (_.transformsEnabled === false) {
			_.$slideTrack.css(positionProps);
		} else {
			positionProps = {};
			if (_.cssTransitions === false) {
				positionProps[_.animType] = "translate(" + x + ", " + y + ")";
				_.$slideTrack.css(positionProps);
			} else {
				positionProps[_.animType] =
					"translate3d(" + x + ", " + y + ", 0px)";
				_.$slideTrack.css(positionProps);
			}
		}
	};

	revSlick.prototype.setDimensions = function () {
		var _ = this;

		if (_.options.vertical === false) {
			if (_.options.centerMode === true) {
				_.$list.css({
					padding: "0px " + _.options.centerPadding,
				});
			}
		} else {
			_.$list.height(
				_.$slides.first().outerHeight(true) * _.options.slidesToShow
			);
			if (_.options.centerMode === true) {
				_.$list.css({
					padding: _.options.centerPadding + " 0px",
				});
			}
		}

		_.listWidth = _.$list.width();
		_.listHeight = _.$list.height();

		if (_.options.vertical === false && _.options.variableWidth === false) {
			_.slideWidth = Math.ceil(_.listWidth / _.options.slidesToShow);
			_.$slideTrack.width(
				Math.ceil(
					_.slideWidth *
						_.$slideTrack.children(".revSlick-slide").length
				)
			);
		} else if (_.options.variableWidth === true) {
			_.$slideTrack.width(5000 * _.slideCount);
		} else {
			_.slideWidth = Math.ceil(_.listWidth);
			_.$slideTrack.height(
				Math.ceil(
					_.$slides.first().outerHeight(true) *
						_.$slideTrack.children(".revSlick-slide").length
				)
			);
		}

		var offset =
			_.$slides.first().outerWidth(true) - _.$slides.first().width();
		if (_.options.variableWidth === false)
			_.$slideTrack
				.children(".revSlick-slide")
				.width(_.slideWidth - offset);
	};

	revSlick.prototype.setFade = function () {
		var _ = this,
			targetLeft;

		_.$slides.each(function (index, element) {
			targetLeft = _.slideWidth * index * -1;
			if (_.options.rtl === true) {
				$(element).css({
					position: "relative",
					right: targetLeft,
					top: 0,
					zIndex: _.options.zIndex - 2,
					opacity: 0,
				});
			} else {
				$(element).css({
					position: "relative",
					left: targetLeft,
					top: 0,
					zIndex: _.options.zIndex - 2,
					opacity: 0,
				});
			}
		});

		_.$slides.eq(_.currentSlide).css({
			zIndex: _.options.zIndex - 1,
			opacity: 1,
		});
	};

	revSlick.prototype.setHeight = function () {
		var _ = this;

		if (
			_.options.slidesToShow === 1 &&
			_.options.adaptiveHeight === true &&
			_.options.vertical === false
		) {
			var targetHeight = _.$slides.eq(_.currentSlide).outerHeight(true);
			_.$list.css("height", targetHeight);
		}
	};

	revSlick.prototype.setOption = revSlick.prototype.revSlickSetOption =
		function () {
			/**
			 * accepts arguments in format of:
			 *
			 *  - for changing a single option's value:
			 *     .revSlick("setOption", option, value, refresh )
			 *
			 *  - for changing a set of responsive options:
			 *     .revSlick("setOption", 'responsive', [{}, ...], refresh )
			 *
			 *  - for updating multiple values at once (not responsive)
			 *     .revSlick("setOption", { 'option': value, ... }, refresh )
			 */

			var _ = this,
				l,
				item,
				option,
				value,
				refresh = false,
				type;

			if ($.type(arguments[0]) === "object") {
				option = arguments[0];
				refresh = arguments[1];
				type = "multiple";
			} else if ($.type(arguments[0]) === "string") {
				option = arguments[0];
				value = arguments[1];
				refresh = arguments[2];

				if (
					arguments[0] === "responsive" &&
					$.type(arguments[1]) === "array"
				) {
					type = "responsive";
				} else if (typeof arguments[1] !== "undefined") {
					type = "single";
				}
			}

			if (type === "single") {
				_.options[option] = value;
			} else if (type === "multiple") {
				$.each(option, function (opt, val) {
					_.options[opt] = val;
				});
			} else if (type === "responsive") {
				for (item in value) {
					if ($.type(_.options.responsive) !== "array") {
						_.options.responsive = [value[item]];
					} else {
						l = _.options.responsive.length - 1;

						// loop through the responsive object and splice out duplicates.
						while (l >= 0) {
							if (
								_.options.responsive[l].breakpoint ===
								value[item].breakpoint
							) {
								_.options.responsive.splice(l, 1);
							}

							l--;
						}

						_.options.responsive.push(value[item]);
					}
				}
			}

			if (refresh) {
				_.unload();
				_.reinit();
			}
		};

	revSlick.prototype.setPosition = function () {
		var _ = this;

		_.setDimensions();

		_.setHeight();

		if (_.options.fade === false) {
			_.setCSS(_.getLeft(_.currentSlide));
		} else {
			_.setFade();
		}

		_.$slider.trigger("setPosition", [_]);
	};

	revSlick.prototype.setProps = function () {
		var _ = this,
			bodyStyle = document.body.style;

		_.positionProp = _.options.vertical === true ? "top" : "left";

		if (_.positionProp === "top") {
			_.$slider.addClass("revSlick-vertical");
		} else {
			_.$slider.removeClass("revSlick-vertical");
		}

		if (
			bodyStyle.WebkitTransition !== undefined ||
			bodyStyle.MozTransition !== undefined ||
			bodyStyle.msTransition !== undefined
		) {
			if (_.options.useCSS === true) {
				_.cssTransitions = true;
			}
		}

		if (_.options.fade) {
			if (typeof _.options.zIndex === "number") {
				if (_.options.zIndex < 3) {
					_.options.zIndex = 3;
				}
			} else {
				_.options.zIndex = _.defaults.zIndex;
			}
		}

		if (bodyStyle.OTransform !== undefined) {
			_.animType = "OTransform";
			_.transformType = "-o-transform";
			_.transitionType = "OTransition";
			if (
				bodyStyle.perspectiveProperty === undefined &&
				bodyStyle.webkitPerspective === undefined
			)
				_.animType = false;
		}
		if (bodyStyle.MozTransform !== undefined) {
			_.animType = "MozTransform";
			_.transformType = "-moz-transform";
			_.transitionType = "MozTransition";
			if (
				bodyStyle.perspectiveProperty === undefined &&
				bodyStyle.MozPerspective === undefined
			)
				_.animType = false;
		}
		if (bodyStyle.webkitTransform !== undefined) {
			_.animType = "webkitTransform";
			_.transformType = "-webkit-transform";
			_.transitionType = "webkitTransition";
			if (
				bodyStyle.perspectiveProperty === undefined &&
				bodyStyle.webkitPerspective === undefined
			)
				_.animType = false;
		}
		if (bodyStyle.msTransform !== undefined) {
			_.animType = "msTransform";
			_.transformType = "-ms-transform";
			_.transitionType = "msTransition";
			if (bodyStyle.msTransform === undefined) _.animType = false;
		}
		if (bodyStyle.transform !== undefined && _.animType !== false) {
			_.animType = "transform";
			_.transformType = "transform";
			_.transitionType = "transition";
		}
		_.transformsEnabled =
			_.options.useTransform &&
			_.animType !== null &&
			_.animType !== false;
	};

	revSlick.prototype.setSlideClasses = function (index) {
		var _ = this,
			centerOffset,
			allSlides,
			indexOffset,
			remainder;

		allSlides = _.$slider
			.find(".revSlick-slide")
			.removeClass("revSlick-active revSlick-center revSlick-current")
			.attr("aria-hidden", "true");

		_.$slides.eq(index).addClass("revSlick-current");

		if (_.options.centerMode === true) {
			var evenCoef = _.options.slidesToShow % 2 === 0 ? 1 : 0;

			centerOffset = Math.floor(_.options.slidesToShow / 2);

			if (_.options.infinite === true) {
				if (
					index >= centerOffset &&
					index <= _.slideCount - 1 - centerOffset
				) {
					_.$slides
						.slice(
							index - centerOffset + evenCoef,
							index + centerOffset + 1
						)
						.addClass("revSlick-active")
						.attr("aria-hidden", "false");
				} else {
					indexOffset = _.options.slidesToShow + index;
					allSlides
						.slice(
							indexOffset - centerOffset + 1 + evenCoef,
							indexOffset + centerOffset + 2
						)
						.addClass("revSlick-active")
						.attr("aria-hidden", "false");
				}

				if (index === 0) {
					allSlides
						.eq(allSlides.length - 1 - _.options.slidesToShow)
						.addClass("revSlick-center");
				} else if (index === _.slideCount - 1) {
					allSlides
						.eq(_.options.slidesToShow)
						.addClass("revSlick-center");
				}
			}

			_.$slides.eq(index).addClass("revSlick-center");
		} else {
			if (index >= 0 && index <= _.slideCount - _.options.slidesToShow) {
				_.$slides
					.slice(index, index + _.options.slidesToShow)
					.addClass("revSlick-active")
					.attr("aria-hidden", "false");
			} else if (allSlides.length <= _.options.slidesToShow) {
				allSlides
					.addClass("revSlick-active")
					.attr("aria-hidden", "false");
			} else {
				remainder = _.slideCount % _.options.slidesToShow;
				indexOffset =
					_.options.infinite === true
						? _.options.slidesToShow + index
						: index;

				if (
					_.options.slidesToShow == _.options.slidesToScroll &&
					_.slideCount - index < _.options.slidesToShow
				) {
					allSlides
						.slice(
							indexOffset - (_.options.slidesToShow - remainder),
							indexOffset + remainder
						)
						.addClass("revSlick-active")
						.attr("aria-hidden", "false");
				} else {
					allSlides
						.slice(
							indexOffset,
							indexOffset + _.options.slidesToShow
						)
						.addClass("revSlick-active")
						.attr("aria-hidden", "false");
				}
			}
		}

		if (
			_.options.lazyLoad === "ondemand" ||
			_.options.lazyLoad === "anticipated"
		) {
			_.lazyLoad();
		}
	};

	revSlick.prototype.setupInfinite = function () {
		var _ = this,
			i,
			slideIndex,
			infiniteCount;

		if (_.options.fade === true) {
			_.options.centerMode = false;
		}

		if (_.options.infinite === true && _.options.fade === false) {
			slideIndex = null;

			if (_.slideCount > _.options.slidesToShow) {
				if (_.options.centerMode === true) {
					infiniteCount = _.options.slidesToShow + 1;
				} else {
					infiniteCount = _.options.slidesToShow;
				}

				for (
					i = _.slideCount;
					i > _.slideCount - infiniteCount;
					i -= 1
				) {
					slideIndex = i - 1;
					$(_.$slides[slideIndex])
						.clone(true)
						.attr("id", "")
						.attr("data-revSlick-index", slideIndex - _.slideCount)
						.prependTo(_.$slideTrack)
						.addClass("revSlick-cloned");
				}
				for (i = 0; i < infiniteCount + _.slideCount; i += 1) {
					slideIndex = i;
					$(_.$slides[slideIndex])
						.clone(true)
						.attr("id", "")
						.attr("data-revSlick-index", slideIndex + _.slideCount)
						.appendTo(_.$slideTrack)
						.addClass("revSlick-cloned");
				}
				_.$slideTrack
					.find(".revSlick-cloned")
					.find("[id]")
					.each(function () {
						$(this).attr("id", "");
					});
			}
		}
	};

	revSlick.prototype.interrupt = function (toggle) {
		var _ = this;

		if (!toggle) {
			_.autoPlay();
		}
		_.interrupted = toggle;
	};

	revSlick.prototype.selectHandler = function (event) {
		var _ = this;

		var targetElement = $(event.target).is(".revSlick-slide")
			? $(event.target)
			: $(event.target).parents(".revSlick-slide");

		var index = parseInt(targetElement.attr("data-revSlick-index"));

		if (!index) index = 0;

		if (_.slideCount <= _.options.slidesToShow) {
			_.slideHandler(index, false, true);
			return;
		}

		_.slideHandler(index);
	};

	revSlick.prototype.slideHandler = function (index, sync, dontAnimate) {
		var targetSlide,
			animSlide,
			oldSlide,
			slideLeft,
			targetLeft = null,
			_ = this,
			navTarget;

		sync = sync || false;

		if (_.animating === true && _.options.waitForAnimate === true) {
			return;
		}

		if (_.options.fade === true && _.currentSlide === index) {
			return;
		}

		if (sync === false) {
			_.asNavFor(index);
		}

		targetSlide = index;
		targetLeft = _.getLeft(targetSlide);
		slideLeft = _.getLeft(_.currentSlide);

		_.currentLeft = _.swipeLeft === null ? slideLeft : _.swipeLeft;

		if (
			_.options.infinite === false &&
			_.options.centerMode === false &&
			(index < 0 || index > _.getDotCount() * _.options.slidesToScroll)
		) {
			if (_.options.fade === false) {
				targetSlide = _.currentSlide;
				if (
					dontAnimate !== true &&
					_.slideCount > _.options.slidesToShow
				) {
					_.animateSlide(slideLeft, function () {
						_.postSlide(targetSlide);
					});
				} else {
					_.postSlide(targetSlide);
				}
			}
			return;
		} else if (
			_.options.infinite === false &&
			_.options.centerMode === true &&
			(index < 0 || index > _.slideCount - _.options.slidesToScroll)
		) {
			if (_.options.fade === false) {
				targetSlide = _.currentSlide;
				if (
					dontAnimate !== true &&
					_.slideCount > _.options.slidesToShow
				) {
					_.animateSlide(slideLeft, function () {
						_.postSlide(targetSlide);
					});
				} else {
					_.postSlide(targetSlide);
				}
			}
			return;
		}

		if (_.options.autoplay) {
			clearInterval(_.autoPlayTimer);
		}

		if (targetSlide < 0) {
			if (_.slideCount % _.options.slidesToScroll !== 0) {
				animSlide =
					_.slideCount - (_.slideCount % _.options.slidesToScroll);
			} else {
				animSlide = _.slideCount + targetSlide;
			}
		} else if (targetSlide >= _.slideCount) {
			if (_.slideCount % _.options.slidesToScroll !== 0) {
				animSlide = 0;
			} else {
				animSlide = targetSlide - _.slideCount;
			}
		} else {
			animSlide = targetSlide;
		}

		_.animating = true;

		_.$slider.trigger("beforeChange", [_, _.currentSlide, animSlide]);

		oldSlide = _.currentSlide;
		_.currentSlide = animSlide;

		_.setSlideClasses(_.currentSlide);

		if (_.options.asNavFor) {
			navTarget = _.getNavTarget();
			navTarget = navTarget.revSlick("getrevSlick");

			if (navTarget.slideCount <= navTarget.options.slidesToShow) {
				navTarget.setSlideClasses(_.currentSlide);
			}
		}

		_.updateDots();
		_.updateArrows();

		if (_.options.fade === true) {
			if (dontAnimate !== true) {
				_.fadeSlideOut(oldSlide);

				_.fadeSlide(animSlide, function () {
					_.postSlide(animSlide);
				});
			} else {
				_.postSlide(animSlide);
			}
			_.animateHeight();
			return;
		}

		if (dontAnimate !== true && _.slideCount > _.options.slidesToShow) {
			_.animateSlide(targetLeft, function () {
				_.postSlide(animSlide);
			});
		} else {
			_.postSlide(animSlide);
		}
	};

	revSlick.prototype.startLoad = function () {
		var _ = this;

		if (
			_.options.arrows === true &&
			_.slideCount > _.options.slidesToShow
		) {
			_.$prevArrow.hide();
			_.$nextArrow.hide();
		}

		if (_.options.dots === true && _.slideCount > _.options.slidesToShow) {
			_.$dots.hide();
		}

		_.$slider.addClass("revSlick-loading");
	};

	revSlick.prototype.swipeDirection = function () {
		var xDist,
			yDist,
			r,
			swipeAngle,
			_ = this;

		xDist = _.touchObject.startX - _.touchObject.curX;
		yDist = _.touchObject.startY - _.touchObject.curY;
		r = Math.atan2(yDist, xDist);

		swipeAngle = Math.round((r * 180) / Math.PI);
		if (swipeAngle < 0) {
			swipeAngle = 360 - Math.abs(swipeAngle);
		}

		if (swipeAngle <= 45 && swipeAngle >= 0) {
			return _.options.rtl === false ? "left" : "right";
		}
		if (swipeAngle <= 360 && swipeAngle >= 315) {
			return _.options.rtl === false ? "left" : "right";
		}
		if (swipeAngle >= 135 && swipeAngle <= 225) {
			return _.options.rtl === false ? "right" : "left";
		}
		if (_.options.verticalSwiping === true) {
			if (swipeAngle >= 35 && swipeAngle <= 135) {
				return "down";
			} else {
				return "up";
			}
		}

		return "vertical";
	};

	revSlick.prototype.swipeEnd = function (event) {
		var _ = this,
			slideCount,
			direction;

		_.dragging = false;
		_.swiping = false;

		if (_.scrolling) {
			_.scrolling = false;
			return false;
		}

		_.interrupted = false;
		_.shouldClick = _.touchObject.swipeLength > 10 ? false : true;

		if (_.touchObject.curX === undefined) {
			return false;
		}

		if (_.touchObject.edgeHit === true) {
			_.$slider.trigger("edge", [_, _.swipeDirection()]);
		}

		if (_.touchObject.swipeLength >= _.touchObject.minSwipe) {
			direction = _.swipeDirection();

			switch (direction) {
				case "left":
				case "down":
					slideCount = _.options.swipeToSlide
						? _.checkNavigable(_.currentSlide + _.getSlideCount())
						: _.currentSlide + _.getSlideCount();

					_.currentDirection = 0;

					break;

				case "right":
				case "up":
					slideCount = _.options.swipeToSlide
						? _.checkNavigable(_.currentSlide - _.getSlideCount())
						: _.currentSlide - _.getSlideCount();

					_.currentDirection = 1;

					break;

				default:
			}

			if (direction != "vertical") {
				_.slideHandler(slideCount);
				_.touchObject = {};
				_.$slider.trigger("swipe", [_, direction]);
			}
		} else {
			if (_.touchObject.startX !== _.touchObject.curX) {
				_.slideHandler(_.currentSlide);
				_.touchObject = {};
			}
		}
	};

	revSlick.prototype.swipeHandler = function (event) {
		var _ = this;

		if (
			_.options.swipe === false ||
			("ontouchend" in document && _.options.swipe === false)
		) {
			return;
		} else if (
			_.options.draggable === false &&
			event.type.indexOf("mouse") !== -1
		) {
			return;
		}

		_.touchObject.fingerCount =
			event.originalEvent && event.originalEvent.touches !== undefined
				? event.originalEvent.touches.length
				: 1;

		_.touchObject.minSwipe = _.listWidth / _.options.touchThreshold;

		if (_.options.verticalSwiping === true) {
			_.touchObject.minSwipe = _.listHeight / _.options.touchThreshold;
		}

		switch (event.data.action) {
			case "start":
				_.swipeStart(event);
				break;

			case "move":
				_.swipeMove(event);
				break;

			case "end":
				_.swipeEnd(event);
				break;
		}
	};

	revSlick.prototype.swipeMove = function (event) {
		var _ = this,
			edgeWasHit = false,
			curLeft,
			swipeDirection,
			swipeLength,
			positionOffset,
			touches,
			verticalSwipeLength;

		touches =
			event.originalEvent !== undefined
				? event.originalEvent.touches
				: null;

		if (!_.dragging || _.scrolling || (touches && touches.length !== 1)) {
			return false;
		}

		curLeft = _.getLeft(_.currentSlide);

		_.touchObject.curX =
			touches !== undefined ? touches[0].pageX : event.clientX;
		_.touchObject.curY =
			touches !== undefined ? touches[0].pageY : event.clientY;

		_.touchObject.swipeLength = Math.round(
			Math.sqrt(Math.pow(_.touchObject.curX - _.touchObject.startX, 2))
		);

		verticalSwipeLength = Math.round(
			Math.sqrt(Math.pow(_.touchObject.curY - _.touchObject.startY, 2))
		);

		if (
			!_.options.verticalSwiping &&
			!_.swiping &&
			verticalSwipeLength > 4
		) {
			_.scrolling = true;
			return false;
		}

		if (_.options.verticalSwiping === true) {
			_.touchObject.swipeLength = verticalSwipeLength;
		}

		swipeDirection = _.swipeDirection();

		if (
			event.originalEvent !== undefined &&
			_.touchObject.swipeLength > 4
		) {
			_.swiping = true;
			event.preventDefault();
		}

		positionOffset =
			(_.options.rtl === false ? 1 : -1) *
			(_.touchObject.curX > _.touchObject.startX ? 1 : -1);
		if (_.options.verticalSwiping === true) {
			positionOffset = _.touchObject.curY > _.touchObject.startY ? 1 : -1;
		}

		swipeLength = _.touchObject.swipeLength;

		_.touchObject.edgeHit = false;

		if (_.options.infinite === false) {
			if (
				(_.currentSlide === 0 && swipeDirection === "right") ||
				(_.currentSlide >= _.getDotCount() && swipeDirection === "left")
			) {
				swipeLength =
					_.touchObject.swipeLength * _.options.edgeFriction;
				_.touchObject.edgeHit = true;
			}
		}

		if (_.options.vertical === false) {
			_.swipeLeft = curLeft + swipeLength * positionOffset;
		} else {
			_.swipeLeft =
				curLeft +
				swipeLength * (_.$list.height() / _.listWidth) * positionOffset;
		}
		if (_.options.verticalSwiping === true) {
			_.swipeLeft = curLeft + swipeLength * positionOffset;
		}

		if (_.options.fade === true || _.options.touchMove === false) {
			return false;
		}

		if (_.animating === true) {
			_.swipeLeft = null;
			return false;
		}

		_.setCSS(_.swipeLeft);
	};

	revSlick.prototype.swipeStart = function (event) {
		var _ = this,
			touches;

		_.interrupted = true;

		if (
			_.touchObject.fingerCount !== 1 ||
			_.slideCount <= _.options.slidesToShow
		) {
			_.touchObject = {};
			return false;
		}

		if (
			event.originalEvent !== undefined &&
			event.originalEvent.touches !== undefined
		) {
			touches = event.originalEvent.touches[0];
		}

		_.touchObject.startX = _.touchObject.curX =
			touches !== undefined ? touches.pageX : event.clientX;
		_.touchObject.startY = _.touchObject.curY =
			touches !== undefined ? touches.pageY : event.clientY;

		_.dragging = true;
	};

	revSlick.prototype.unfilterSlides = revSlick.prototype.revSlickUnfilter =
		function () {
			var _ = this;

			if (_.$slidesCache !== null) {
				_.unload();

				_.$slideTrack.children(this.options.slide).detach();

				_.$slidesCache.appendTo(_.$slideTrack);

				_.reinit();
			}
		};

	revSlick.prototype.unload = function () {
		var _ = this;

		$(".revSlick-cloned", _.$slider).remove();

		if (_.$dots) {
			_.$dots.remove();
		}

		if (_.$prevArrow && _.htmlExpr.test(_.options.prevArrow)) {
			_.$prevArrow.remove();
		}

		if (_.$nextArrow && _.htmlExpr.test(_.options.nextArrow)) {
			_.$nextArrow.remove();
		}

		_.$slides
			.removeClass(
				"revSlick-slide revSlick-active revSlick-visible revSlick-current"
			)
			.attr("aria-hidden", "true")
			.css("width", "");
	};

	revSlick.prototype.unrevSlick = function (fromBreakpoint) {
		var _ = this;
		_.$slider.trigger("unrevSlick", [_, fromBreakpoint]);
		_.destroy();
	};

	revSlick.prototype.updateArrows = function () {
		var _ = this,
			centerOffset;

		centerOffset = Math.floor(_.options.slidesToShow / 2);

		if (
			_.options.arrows === true &&
			_.slideCount > _.options.slidesToShow &&
			!_.options.infinite
		) {
			_.$prevArrow
				.removeClass("revSlick-disabled")
				.attr("aria-disabled", "false");
			_.$nextArrow
				.removeClass("revSlick-disabled")
				.attr("aria-disabled", "false");

			if (_.currentSlide === 0) {
				_.$prevArrow
					.addClass("revSlick-disabled")
					.attr("aria-disabled", "true");
				_.$nextArrow
					.removeClass("revSlick-disabled")
					.attr("aria-disabled", "false");
			} else if (
				_.currentSlide >= _.slideCount - _.options.slidesToShow &&
				_.options.centerMode === false
			) {
				_.$nextArrow
					.addClass("revSlick-disabled")
					.attr("aria-disabled", "true");
				_.$prevArrow
					.removeClass("revSlick-disabled")
					.attr("aria-disabled", "false");
			} else if (
				_.currentSlide >= _.slideCount - 1 &&
				_.options.centerMode === true
			) {
				_.$nextArrow
					.addClass("revSlick-disabled")
					.attr("aria-disabled", "true");
				_.$prevArrow
					.removeClass("revSlick-disabled")
					.attr("aria-disabled", "false");
			}
		}
	};

	revSlick.prototype.updateDots = function () {
		var _ = this;

		if (_.$dots !== null) {
			_.$dots.find("li").removeClass("revSlick-active").end();

			_.$dots
				.find("li")
				.eq(Math.floor(_.currentSlide / _.options.slidesToScroll))
				.addClass("revSlick-active");
		}
	};

	revSlick.prototype.visibility = function () {
		var _ = this;

		if (_.options.autoplay) {
			if (document[_.hidden]) {
				_.interrupted = true;
			} else {
				_.interrupted = false;
			}
		}
	};

	$.fn.revSlick = function () {
		var _ = this,
			opt = arguments[0],
			args = Array.prototype.slice.call(arguments, 1),
			l = _.length,
			i,
			ret;
		for (i = 0; i < l; i++) {
			if (typeof opt == "object" || typeof opt == "undefined")
				_[i].revSlick = new revSlick(_[i], opt);
			else ret = _[i].revSlick[opt].apply(_[i].revSlick, args);
			if (typeof ret != "undefined") return ret;
		}
		return _;
	};
});
