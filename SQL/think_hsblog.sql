/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.5.53 : Database - think_hsblog
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`think_hsblog` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `think_hsblog`;

/*Table structure for table `hsblog_article_category` */

DROP TABLE IF EXISTS `hsblog_article_category`;

CREATE TABLE `hsblog_article_category` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `ac_name` varchar(64) DEFAULT NULL COMMENT '分类名',
  `ac_sort` tinyint(4) DEFAULT NULL COMMENT '分类排序',
  `ac_state` tinyint(4) DEFAULT '1' COMMENT '分类状态1正常显示0禁用',
  `ac_description` varchar(128) DEFAULT NULL COMMENT '分类描述',
  PRIMARY KEY (`ac_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `hsblog_article_category` */

insert  into `hsblog_article_category`(`ac_id`,`ac_name`,`ac_sort`,`ac_state`,`ac_description`) values (1,'PHP',1,1,'PHP'),(2,'MySQL',2,1,'MySQL');

/*Table structure for table `hsblog_article_tag` */

DROP TABLE IF EXISTS `hsblog_article_tag`;

CREATE TABLE `hsblog_article_tag` (
  `at_article_id` int(11) DEFAULT NULL COMMENT '文章id一对多',
  `at_tag_id` int(11) DEFAULT NULL COMMENT '标签id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `hsblog_article_tag` */

insert  into `hsblog_article_tag`(`at_article_id`,`at_tag_id`) values (5,3),(1,2);

/*Table structure for table `hsblog_articles` */

DROP TABLE IF EXISTS `hsblog_articles`;

CREATE TABLE `hsblog_articles` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `a_title` varchar(64) DEFAULT NULL COMMENT '文章标题',
  `a_author` varchar(64) DEFAULT 'haoshuai_it' COMMENT '文章作者',
  `a_content` mediumtext COMMENT '文章内容',
  `a_keywords` varchar(64) DEFAULT NULL COMMENT '文章关键字',
  `a_description` text COMMENT '文章描述',
  `a_img_url` varchar(256) DEFAULT NULL COMMENT '文章列表图片url',
  `a_is_top` tinyint(4) DEFAULT '0' COMMENT '是否置顶 1置顶 默认0',
  `a_is_original` tinyint(4) DEFAULT '1' COMMENT '是否原创 1是 0否 默认1',
  `a_is_comment` tinyint(4) DEFAULT '1' COMMENT '是否允许评论 1是 0否 默认1',
  `a_click_view` int(11) DEFAULT '0' COMMENT '文章点击数',
  `a_category_id` varchar(32) DEFAULT NULL COMMENT '分类id',
  `a_state` tinyint(4) DEFAULT '1' COMMENT '状态 1正常 0禁止显示 2放置回收站',
  `a_add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '文章发表时间',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `hsblog_articles` */

insert  into `hsblog_articles`(`a_id`,`a_title`,`a_author`,`a_content`,`a_keywords`,`a_description`,`a_img_url`,`a_is_top`,`a_is_original`,`a_is_comment`,`a_click_view`,`a_category_id`,`a_state`,`a_add_time`) values (1,'Git推送到服务器后自动同步到站点目录www','haoshuai_it','<pre class=\"prettyprint lang-js\">/*\r\nselectivizr v1.0.2 - (c) Keith Clark, freely distributable under the terms \r\nof the MIT license.\r\n\r\nselectivizr.com\r\n*/\r\n/* \r\n  \r\nNotes about this source\r\n-----------------------\r\n\r\n * The #DEBUG_START and #DEBUG_END comments are used to mark blocks of code\r\n   that will be removed prior to building a final release version (using a\r\n   pre-compression script)\r\n  \r\n  \r\nReferences:\r\n-----------\r\n \r\n * CSS Syntax          : http://www.w3.org/TR/2003/WD-css3-syntax-20030813/#style\r\n * Selectors           : http://www.w3.org/TR/css3-selectors/#selectors\r\n * IE Compatability    : http://msdn.microsoft.com/en-us/library/cc351024(VS.85).aspx\r\n * W3C Selector Tests  : http://www.w3.org/Style/CSS/Test/CSS3/Selectors/current/html/tests/\r\n \r\n*/\r\n\r\n(function(win) {\r\n\r\n    // If browser isn\'t IE, then stop execution! This handles the script \r\n    // being loaded by non IE browsers because the developer didn\'t use \r\n    // conditional comments.\r\n    if (\r\n    /*@cc_on!@*/\r\n    true) return;\r\n\r\n    // =========================== Init Objects ============================\r\n    var doc = document;\r\n    var root = doc.documentElement;\r\n    var xhr = getXHRObject();\r\n    var ieVersion = /MSIE (\\d+)/.exec(navigator.userAgent)[1];\r\n\r\n    // If were not in standards mode, IE is too old / new or we can\'t create\r\n    // an XMLHttpRequest object then we should get out now.\r\n    if (doc.compatMode != \'CSS1Compat\' || ieVersion &lt; 6 || ieVersion &gt; 8 || !xhr) {\r\n        return;\r\n    }\r\n\r\n    // ========================= Common Objects ============================\r\n    // Compatiable selector engines in order of CSS3 support. Note: \'*\' is\r\n    // a placholder for the object key name. (basically, crude compression)\r\n    var selectorEngines = {\r\n        \"NW\": \"*.Dom.select\",\r\n        \"MooTools\": \"$$\",\r\n        \"DOMAssistant\": \"*.$\",\r\n        \"Prototype\": \"$$\",\r\n        \"YAHOO\": \"*.util.Selector.query\",\r\n        \"Sizzle\": \"*\",\r\n        \"jQuery\": \"*\",\r\n        \"dojo\": \"*.query\"\r\n    };\r\n\r\n    var selectorMethod;\r\n    var enabledWatchers = []; // array of :enabled/:disabled elements to poll\r\n    var ie6PatchID = 0; // used to solve ie6\'s multiple class bug\r\n    var patchIE6MultipleClasses = true; // if true adds class bloat to ie6\r\n    var namespace = \"slvzr\";\r\n\r\n    // Stylesheet parsing regexp\'s\r\n    var RE_COMMENT = /(\\/\\*[^*]*\\*+([^\\/][^*]*\\*+)*\\/)\\s*/g;\r\n    var RE_IMPORT = /@import\\s*(?:(?:(?:url\\(\\s*([\'\"]?)(.*)\\1)\\s*\\))|(?:([\'\"])(.*)\\3))[^;]*;/g;\r\n    var RE_ASSET_URL = /\\burl\\(\\s*([\"\']?)(?!data:)([^\"\')]+)\\1\\s*\\)/g;\r\n    var RE_PSEUDO_STRUCTURAL = /^:(empty|(first|last|only|nth(-last)?)-(child|of-type))$/;\r\n    var RE_PSEUDO_ELEMENTS = /:(:first-(?:line|letter))/g;\r\n    var RE_SELECTOR_GROUP = /(^|})\\s*([^\\{]*?[\\[:][^{]+)/g;\r\n    var RE_SELECTOR_PARSE = /([ +~&gt;])|(:[a-z-]+(?:\\(.*?\\)+)?)|(\\[.*?\\])/g;\r\n    var RE_LIBRARY_INCOMPATIBLE_PSEUDOS = /(:not\\()?:(hover|enabled|disabled|focus|checked|target|active|visited|first-line|first-letter)\\)?/g;\r\n    var RE_PATCH_CLASS_NAME_REPLACE = /[^\\w-]/g;\r\n\r\n    // HTML UI element regexp\'s\r\n    var RE_INPUT_ELEMENTS = /^(INPUT|SELECT|TEXTAREA|BUTTON)$/;\r\n    var RE_INPUT_CHECKABLE_TYPES = /^(checkbox|radio)$/;\r\n\r\n    // Broken attribute selector implementations (IE7/8 native [^=\"\"], [$=\"\"] and [*=\"\"])\r\n    var BROKEN_ATTR_IMPLEMENTATIONS = ieVersion &gt; 6 ? /[\\$\\^*]=([\'\"])\\1/: null;\r\n\r\n    // Whitespace normalization regexp\'s\r\n    var RE_TIDY_TRAILING_WHITESPACE = /([(\\[+~])\\s+/g;\r\n    var RE_TIDY_LEADING_WHITESPACE = /\\s+([)\\]+~])/g;\r\n    var RE_TIDY_CONSECUTIVE_WHITESPACE = /\\s+/g;\r\n    var RE_TIDY_TRIM_WHITESPACE = /^\\s*((?:[\\S\\s]*\\S)?)\\s*$/;\r\n\r\n    // String constants\r\n    var EMPTY_STRING = \"\";\r\n    var SPACE_STRING = \" \";\r\n    var PLACEHOLDER_STRING = \"$1\";\r\n\r\n    // =========================== Patching ================================\r\n    // --[ patchStyleSheet() ]----------------------------------------------\r\n    // Scans the passed cssText for selectors that require emulation and\r\n    // creates one or more patches for each matched selector.\r\n    function patchStyleSheet(cssText) {\r\n        return cssText.replace(RE_PSEUDO_ELEMENTS, PLACEHOLDER_STRING).replace(RE_SELECTOR_GROUP,\r\n        function(m, prefix, selectorText) {\r\n            var selectorGroups = selectorText.split(\",\");\r\n            for (var c = 0,\r\n            cs = selectorGroups.length; c &lt; cs; c++) {\r\n                var selector = normalizeSelectorWhitespace(selectorGroups[c]) + SPACE_STRING;\r\n                var patches = [];\r\n                selectorGroups[c] = selector.replace(RE_SELECTOR_PARSE,\r\n                function(match, combinator, pseudo, attribute, index) {\r\n                    if (combinator) {\r\n                        if (patches.length &gt; 0) {\r\n                            applyPatches(selector.substring(0, index), patches);\r\n                            patches = [];\r\n                        }\r\n                        return combinator;\r\n                    } else {\r\n                        var patch = (pseudo) ? patchPseudoClass(pseudo) : patchAttribute(attribute);\r\n                        if (patch) {\r\n                            patches.push(patch);\r\n                            return \".\" + patch.className;\r\n                        }\r\n                        return match;\r\n                    }\r\n                });\r\n            }\r\n            return prefix + selectorGroups.join(\",\");\r\n        });\r\n    };\r\n\r\n    // --[ patchAttribute() ]-----------------------------------------------\r\n    // returns a patch for an attribute selector.\r\n    function patchAttribute(attr) {\r\n        return (!BROKEN_ATTR_IMPLEMENTATIONS || BROKEN_ATTR_IMPLEMENTATIONS.test(attr)) ? {\r\n            className: createClassName(attr),\r\n            applyClass: true\r\n        }: null;\r\n    };\r\n\r\n    // --[ patchPseudoClass() ]---------------------------------------------\r\n    // returns a patch for a pseudo-class\r\n    function patchPseudoClass(pseudo) {\r\n\r\n        var applyClass = true;\r\n        var className = createClassName(pseudo.slice(1));\r\n        var isNegated = pseudo.substring(0, 5) == \":not(\";\r\n        var activateEventName;\r\n        var deactivateEventName;\r\n\r\n        // if negated, remove :not() \r\n        if (isNegated) {\r\n            pseudo = pseudo.slice(5, -1);\r\n        }\r\n\r\n        // bracket contents are irrelevant - remove them\r\n        var bracketIndex = pseudo.indexOf(\"(\") if (bracketIndex &gt; -1) {\r\n            pseudo = pseudo.substring(0, bracketIndex);\r\n        }\r\n\r\n        // check we\'re still dealing with a pseudo-class\r\n        if (pseudo.charAt(0) == \":\") {\r\n            switch (pseudo.slice(1)) {\r\n\r\n            case \"root\":\r\n                applyClass = function(e) {\r\n                    return isNegated ? e != root: e == root;\r\n                }\r\n                break;\r\n\r\n            case \"target\":\r\n                // :target is only supported in IE8\r\n                if (ieVersion == 8) {\r\n                    applyClass = function(e) {\r\n                        var handler = function() {\r\n                            var hash = location.hash;\r\n                            var hashID = hash.slice(1);\r\n                            return isNegated ? (hash == EMPTY_STRING || e.id != hashID) : (hash != EMPTY_STRING &amp;&amp; e.id == hashID);\r\n                        };\r\n                        addEvent(win, \"hashchange\",\r\n                        function() {\r\n                            toggleElementClass(e, className, handler());\r\n                        }) return handler();\r\n                    }\r\n                    break;\r\n                }\r\n                return false;\r\n\r\n            case \"checked\":\r\n                applyClass = function(e) {\r\n                    if (RE_INPUT_CHECKABLE_TYPES.test(e.type)) {\r\n                        addEvent(e, \"propertychange\",\r\n                        function() {\r\n                            if (event.propertyName == \"checked\") {\r\n                                toggleElementClass(e, className, e.checked !== isNegated);\r\n                            }\r\n                        })\r\n                    }\r\n                    return e.checked !== isNegated;\r\n                }\r\n                break;\r\n\r\n            case \"disabled\":\r\n                isNegated = !isNegated;\r\n\r\n            case \"enabled\":\r\n                applyClass = function(e) {\r\n                    if (RE_INPUT_ELEMENTS.test(e.tagName)) {\r\n                        addEvent(e, \"propertychange\",\r\n                        function() {\r\n                            if (event.propertyName == \"$disabled\") {\r\n                                toggleElementClass(e, className, e.$disabled === isNegated);\r\n                            }\r\n                        });\r\n                        enabledWatchers.push(e);\r\n                        e.$disabled = e.disabled;\r\n                        return e.disabled === isNegated;\r\n                    }\r\n                    return pseudo == \":enabled\" ? isNegated: !isNegated;\r\n                }\r\n                break;\r\n\r\n            case \"focus\":\r\n                activateEventName = \"focus\";\r\n                deactivateEventName = \"blur\";\r\n\r\n            case \"hover\":\r\n                if (!activateEventName) {\r\n                    activateEventName = \"mouseenter\";\r\n                    deactivateEventName = \"mouseleave\";\r\n                }\r\n                applyClass = function(e) {\r\n                    addEvent(e, isNegated ? deactivateEventName: activateEventName,\r\n                    function() {\r\n                        toggleElementClass(e, className, true);\r\n                    }) addEvent(e, isNegated ? activateEventName: deactivateEventName,\r\n                    function() {\r\n                        toggleElementClass(e, className, false);\r\n                    }) return isNegated;\r\n                }\r\n                break;\r\n\r\n                // everything else\r\n            default:\r\n                // If we don\'t support this pseudo-class don\'t create \r\n                // a patch for it\r\n                if (!RE_PSEUDO_STRUCTURAL.test(pseudo)) {\r\n                    return false;\r\n                }\r\n                break;\r\n            }\r\n        }\r\n        return {\r\n            className: className,\r\n            applyClass: applyClass\r\n        };\r\n    };\r\n\r\n    // --[ applyPatches() ]-------------------------------------------------\r\n    // uses the passed selector text to find DOM nodes and patch them	\r\n    function applyPatches(selectorText, patches) {\r\n        var elms;\r\n\r\n        // Although some selector libraries can find :checked :enabled etc. \r\n        // we need to find all elements that could have that state because \r\n        // it can be changed by the user.\r\n        var domSelectorText = selectorText.replace(RE_LIBRARY_INCOMPATIBLE_PSEUDOS, EMPTY_STRING);\r\n\r\n        // If the dom selector equates to an empty string or ends with \r\n        // whitespace then we need to append a universal selector (*) to it.\r\n        if (domSelectorText == EMPTY_STRING || domSelectorText.charAt(domSelectorText.length - 1) == SPACE_STRING) {\r\n            domSelectorText += \"*\";\r\n        }\r\n\r\n        // Ensure we catch errors from the selector library\r\n        try {\r\n            elms = selectorMethod(domSelectorText);\r\n        } catch(ex) {\r\n            // #DEBUG_START\r\n            log(\"Selector \'\" + selectorText + \"\' threw exception \'\" + ex + \"\'\");\r\n            // #DEBUG_END\r\n        }\r\n\r\n        if (elms) {\r\n            for (var d = 0,\r\n            dl = elms.length; d &lt; dl; d++) {\r\n                var elm = elms[d];\r\n                var cssClasses = elm.className;\r\n                for (var f = 0,\r\n                fl = patches.length; f &lt; fl; f++) {\r\n                    var patch = patches[f];\r\n\r\n                    if (!hasPatch(elm, patch)) {\r\n                        if (patch.applyClass &amp;&amp; (patch.applyClass === true || patch.applyClass(elm) === true)) {\r\n                            cssClasses = toggleClass(cssClasses, patch.className, true);\r\n                        }\r\n                    }\r\n                }\r\n                elm.className = cssClasses;\r\n            }\r\n        }\r\n    };\r\n\r\n    // --[ hasPatch() ]-----------------------------------------------------\r\n    // checks for the exsistence of a patch on an element\r\n    function hasPatch(elm, patch) {\r\n        return new RegExp(\"(^|\\\\s)\" + patch.className + \"(\\\\s|$)\").test(elm.className);\r\n    };\r\n\r\n    // =========================== Utility =================================\r\n    function createClassName(className) {\r\n        return namespace + \"-\" + ((ieVersion == 6 &amp;&amp; patchIE6MultipleClasses) ? ie6PatchID++:className.replace(RE_PATCH_CLASS_NAME_REPLACE,\r\n        function(a) {\r\n            return a.charCodeAt(0)\r\n        }));\r\n    };\r\n\r\n    // --[ log() ]----------------------------------------------------------\r\n    // #DEBUG_START\r\n    function log(message) {\r\n        if (win.console) {\r\n            win.console.log(message);\r\n        }\r\n    };\r\n    // #DEBUG_END\r\n    // --[ trim() ]---------------------------------------------------------\r\n    // removes leading, trailing whitespace from a string\r\n    function trim(text) {\r\n        return text.replace(RE_TIDY_TRIM_WHITESPACE, PLACEHOLDER_STRING);\r\n    };\r\n\r\n    // --[ normalizeWhitespace() ]------------------------------------------\r\n    // removes leading, trailing and consecutive whitespace from a string\r\n    function normalizeWhitespace(text) {\r\n        return trim(text).replace(RE_TIDY_CONSECUTIVE_WHITESPACE, SPACE_STRING);\r\n    };\r\n\r\n    // --[ normalizeSelectorWhitespace() ]----------------------------------\r\n    // tidies whitespace around selector brackets and combinators\r\n    function normalizeSelectorWhitespace(selectorText) {\r\n        return normalizeWhitespace(selectorText.replace(RE_TIDY_TRAILING_WHITESPACE, PLACEHOLDER_STRING).replace(RE_TIDY_LEADING_WHITESPACE, PLACEHOLDER_STRING));\r\n    };\r\n\r\n    // --[ toggleElementClass() ]-------------------------------------------\r\n    // toggles a single className on an element\r\n    function toggleElementClass(elm, className, on) {\r\n        var oldClassName = elm.className;\r\n        var newClassName = toggleClass(oldClassName, className, on);\r\n        if (newClassName != oldClassName) {\r\n            elm.className = newClassName;\r\n            elm.parentNode.className += EMPTY_STRING;\r\n        }\r\n    };\r\n\r\n    // --[ toggleClass() ]--------------------------------------------------\r\n    // adds / removes a className from a string of classNames. Used to \r\n    // manage multiple class changes without forcing a DOM redraw\r\n    function toggleClass(classList, className, on) {\r\n        var re = RegExp(\"(^|\\\\s)\" + className + \"(\\\\s|$)\");\r\n        var classExists = re.test(classList);\r\n        if (on) {\r\n            return classExists ? classList: classList + SPACE_STRING + className;\r\n        } else {\r\n            return classExists ? trim(classList.replace(re, PLACEHOLDER_STRING)) : classList;\r\n        }\r\n    };\r\n\r\n    // --[ addEvent() ]-----------------------------------------------------\r\n    function addEvent(elm, eventName, eventHandler) {\r\n        elm.attachEvent(\"on\" + eventName, eventHandler);\r\n    };\r\n\r\n    // --[ getXHRObject() ]-------------------------------------------------\r\n    function getXHRObject() {\r\n        if (win.XMLHttpRequest) {\r\n            return new XMLHttpRequest;\r\n        }\r\n        try {\r\n            return new ActiveXObject(\'Microsoft.XMLHTTP\');\r\n        } catch(e) {\r\n            return null;\r\n        }\r\n    };\r\n\r\n    // --[ loadStyleSheet() ]-----------------------------------------------\r\n    function loadStyleSheet(url) {\r\n        xhr.open(\"GET\", url, false);\r\n        xhr.send();\r\n        return (xhr.status == 200) ? xhr.responseText: EMPTY_STRING;\r\n    };\r\n\r\n    // --[ resolveUrl() ]---------------------------------------------------\r\n    // Converts a URL fragment to a fully qualified URL using the specified\r\n    // context URL. Returns null if same-origin policy is broken\r\n    function resolveUrl(url, contextUrl) {\r\n\r\n        function getProtocolAndHost(url) {\r\n            return url.substring(0, url.indexOf(\"/\", 8));\r\n        };\r\n\r\n        // absolute path\r\n        if (/^https?:\\/\\//i.test(url)) {\r\n            return getProtocolAndHost(contextUrl) == getProtocolAndHost(url) ? url: null;\r\n        }\r\n\r\n        // root-relative path\r\n        if (url.charAt(0) == \"/\") {\r\n            return getProtocolAndHost(contextUrl) + url;\r\n        }\r\n\r\n        // relative path\r\n        var contextUrlPath = contextUrl.split(/[?#]/)[0]; // ignore query string in the contextUrl	\r\n        if (url.charAt(0) != \"?\" &amp;&amp; contextUrlPath.charAt(contextUrlPath.length - 1) != \"/\") {\r\n            contextUrlPath = contextUrlPath.substring(0, contextUrlPath.lastIndexOf(\"/\") + 1);\r\n        }\r\n\r\n        return contextUrlPath + url;\r\n    };\r\n\r\n    // --[ parseStyleSheet() ]----------------------------------------------\r\n    // Downloads the stylesheet specified by the URL, removes it\'s comments\r\n    // and recursivly replaces @import rules with their contents, ultimately\r\n    // returning the full cssText.\r\n    function parseStyleSheet(url) {\r\n        if (url) {\r\n            return loadStyleSheet(url).replace(RE_COMMENT, EMPTY_STRING).replace(RE_IMPORT,\r\n            function(match, quoteChar, importUrl, quoteChar2, importUrl2) {\r\n                return parseStyleSheet(resolveUrl(importUrl || importUrl2, url));\r\n            }).replace(RE_ASSET_URL,\r\n            function(match, quoteChar, assetUrl) {\r\n                quoteChar = quoteChar || EMPTY_STRING;\r\n                return \" url(\" + quoteChar + resolveUrl(assetUrl, url) + quoteChar + \") \";\r\n            });\r\n        }\r\n        return EMPTY_STRING;\r\n    };\r\n\r\n    // --[ init() ]---------------------------------------------------------\r\n    function init() {\r\n        // honour thetag\r\n        var url, stylesheet;\r\n        var baseTags = doc.getElementsByTagName(\"BASE\");\r\n        var baseUrl = (baseTags.length &gt; 0) ? baseTags[0].href: doc.location.href;\r\n\r\n        /* Note: This code prevents IE from freezing / crashing when using \r\n		@font-face .eot files but it modifies thetag and could\r\n		trigger the IE stylesheet limit. It will also cause FOUC issues.\r\n		If you choose to use it, make sure you comment out the for loop \r\n		directly below this comment.\r\n\r\n		var head = doc.getElementsByTagName(\"head\")[0];\r\n		for (var c=doc.styleSheets.length-1; c&gt;=0; c--) {\r\n			stylesheet = doc.styleSheets[c]\r\n			head.appendChild(doc.createElement(\"style\"))\r\n			var patchedStylesheet = doc.styleSheets[doc.styleSheets.length-1];\r\n			\r\n			if (stylesheet.href != EMPTY_STRING) {\r\n				url = resolveUrl(stylesheet.href, baseUrl)\r\n				if (url) {\r\n					patchedStylesheet.cssText = patchStyleSheet( parseStyleSheet( url ) )\r\n					stylesheet.disabled = true\r\n					setTimeout( function () {\r\n						stylesheet.owningElement.parentNode.removeChild(stylesheet.owningElement)\r\n					})\r\n				}\r\n			}\r\n		}\r\n		*/\r\n\r\n        for (var c = 0; c &lt; doc.styleSheets.length; c++) {\r\n            stylesheet = doc.styleSheets[c]\r\n            if (stylesheet.href != EMPTY_STRING) {\r\n                url = resolveUrl(stylesheet.href, baseUrl);\r\n                if (url) {\r\n                    stylesheet.cssText = patchStyleSheet(parseStyleSheet(url));\r\n                }\r\n            }\r\n        }\r\n\r\n        // :enabled &amp; :disabled polling script (since we can\'t hook \r\n        // onpropertychange event when an element is disabled) \r\n        if (enabledWatchers.length &gt; 0) {\r\n            setInterval(function() {\r\n                for (var c = 0,\r\n                cl = enabledWatchers.length; c &lt; cl; c++) {\r\n                    var e = enabledWatchers[c];\r\n                    if (e.disabled !== e.$disabled) {\r\n                        if (e.disabled) {\r\n                            e.disabled = false;\r\n                            e.$disabled = true;\r\n                            e.disabled = true;\r\n                        } else {\r\n                            e.$disabled = e.disabled;\r\n                        }\r\n                    }\r\n                }\r\n            },\r\n            250)\r\n        }\r\n    };\r\n\r\n    // Bind selectivizr to the ContentLoaded event. \r\n    ContentLoaded(win,\r\n    function() {\r\n        // Determine the \"best fit\" selector engine\r\n        for (var engine in selectorEngines) {\r\n            var members, member, context = win;\r\n            if (win[engine]) {\r\n                members = selectorEngines[engine].replace(\"*\", engine).split(\".\");\r\n                while ((member = members.shift()) &amp;&amp; (context = context[member])) {}\r\n                if (typeof context == \"function\") {\r\n                    selectorMethod = context;\r\n                    init();\r\n                    return;\r\n                }\r\n            }\r\n        }\r\n    });\r\n\r\n    /*!\r\n	 * ContentLoaded.js by Diego Perini, modified for IE&lt;9 only (to save space)\r\n	 *\r\n	 * Author: Diego Perini (diego.perini at gmail.com)\r\n	 * Summary: cross-browser wrapper for DOMContentLoaded\r\n	 * Updated: 20101020\r\n	 * License: MIT\r\n	 * Version: 1.2\r\n	 *\r\n	 * URL:\r\n	 * http://javascript.nwbox.com/ContentLoaded/\r\n	 * http://javascript.nwbox.com/ContentLoaded/MIT-LICENSE\r\n	 *\r\n	 */\r\n\r\n    // @w window reference\r\n    // @f function reference\r\n    function ContentLoaded(win, fn) {\r\n\r\n        var done = false,\r\n        top = true,\r\n        init = function(e) {\r\n            if (e.type == \"readystatechange\" &amp;&amp; doc.readyState != \"complete\") return; (e.type == \"load\" ? win: doc).detachEvent(\"on\" + e.type, init, false);\r\n            if (!done &amp;&amp; (done = true)) fn.call(win, e.type || e);\r\n        },\r\n        poll = function() {\r\n            try {\r\n                root.doScroll(\"left\");\r\n            } catch(e) {\r\n                setTimeout(poll, 50);\r\n                return;\r\n            }\r\n            init(\'poll\');\r\n        };\r\n\r\n        if (doc.readyState == \"complete\") fn.call(win, EMPTY_STRING);\r\n        else {\r\n            if (doc.createEventObject &amp;&amp; root.doScroll) {\r\n                try {\r\n                    top = !win.frameElement;\r\n                } catch(e) {}\r\n                if (top) poll();\r\n            }\r\n            addEvent(doc, \"readystatechange\", init);\r\n            addEvent(win, \"load\", init);\r\n        }\r\n    };\r\n})(this);</pre>','Git推送到服务器后自动同步到站点目录www','',NULL,0,1,1,0,'1',1,'2016-09-14 17:51:59'),(5,'PHP字符串的heredoc和nowdoc语法结构','haoshuai_it','<pre class=\"prettyprint lang-html\">&lt;!doctype html&gt;\r\n&lt;html&gt;\r\n  \r\n  &lt;head&gt;\r\n    &lt;meta charset=\"utf-8\" /&gt;\r\n    &lt;title&gt;Default Examples&lt;/title&gt;\r\n    &lt;style&gt;form { margin: 0; } textarea { display: block; }&lt;/style&gt;\r\n    &lt;link rel=\"stylesheet\" href=\"../themes/default/default.css\" /&gt;\r\n    &lt;script charset=\"utf-8\" src=\"../kindeditor-min.js\"&gt;&lt;/script&gt;\r\n    &lt;script charset=\"utf-8\" src=\"../lang/zh_CN.js\"&gt;&lt;/script&gt;\r\n    &lt;script&gt;var editor;\r\n      KindEditor.ready(function(K) {\r\n        editor = K.create(\'textarea[name=\"content\"]\', {\r\n          allowFileManager: true\r\n        });\r\n        K(\'input[name=getHtml]\').click(function(e) {\r\n          alert(editor.html());\r\n        });\r\n        K(\'input[name=isEmpty]\').click(function(e) {\r\n          alert(editor.isEmpty());\r\n        });\r\n        K(\'input[name=getText]\').click(function(e) {\r\n          alert(editor.text());\r\n        });\r\n        K(\'input[name=selectedHtml]\').click(function(e) {\r\n          alert(editor.selectedHtml());\r\n        });\r\n        K(\'input[name=setHtml]\').click(function(e) {\r\n          editor.html(\'&lt;h3&gt;Hello KindEditor&lt;/h3&gt;\');\r\n        });\r\n        K(\'input[name=setText]\').click(function(e) {\r\n          editor.text(\'&lt;h3&gt;Hello KindEditor&lt;/h3&gt;\');\r\n        });\r\n        K(\'input[name=insertHtml]\').click(function(e) {\r\n          editor.insertHtml(\'&lt;strong&gt;插入HTML&lt;/strong&gt;\');\r\n        });\r\n        K(\'input[name=appendHtml]\').click(function(e) {\r\n          editor.appendHtml(\'&lt;strong&gt;添加HTML&lt;/strong&gt;\');\r\n        });\r\n        K(\'input[name=clear]\').click(function(e) {\r\n          editor.html(\'\');\r\n        });\r\n      });&lt;/script&gt;\r\n  &lt;/head&gt;\r\n  \r\n  &lt;body&gt;\r\n    &lt;h3&gt;默认模式&lt;/h3&gt;\r\n    &lt;form&gt;\r\n      &lt;textarea name=\"content\" style=\"width:800px;height:400px;visibility:hidden;\"&gt;KindEditor&lt;/textarea&gt;\r\n      &lt;p&gt;\r\n        &lt;input type=\"button\" name=\"getHtml\" value=\"取得HTML\" /&gt;\r\n        &lt;input type=\"button\" name=\"isEmpty\" value=\"判断是否为空\" /&gt;\r\n        &lt;input type=\"button\" name=\"getText\" value=\"取得文本(包含img,embed)\" /&gt;\r\n        &lt;input type=\"button\" name=\"selectedHtml\" value=\"取得选中HTML\" /&gt;\r\n        &lt;br /&gt;\r\n        &lt;br /&gt;\r\n        &lt;input type=\"button\" name=\"setHtml\" value=\"设置HTML\" /&gt;\r\n        &lt;input type=\"button\" name=\"setText\" value=\"设置文本\" /&gt;\r\n        &lt;input type=\"button\" name=\"insertHtml\" value=\"插入HTML\" /&gt;\r\n        &lt;input type=\"button\" name=\"appendHtml\" value=\"添加HTML\" /&gt;\r\n        &lt;input type=\"button\" name=\"clear\" value=\"清空内容\" /&gt;\r\n        &lt;input type=\"reset\" name=\"reset\" value=\"Reset\" /&gt;&lt;/p&gt;\r\n    &lt;/form&gt;\r\n  &lt;/body&gt;\r\n\r\n&lt;/html&gt;</pre>','PHP字符串的heredoc和nowdoc语法结构','',NULL,0,1,1,0,'1',1,'2016-09-20 15:41:06');

/*Table structure for table `hsblog_link` */

DROP TABLE IF EXISTS `hsblog_link`;

CREATE TABLE `hsblog_link` (
  `hl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '友情链接id',
  `hl_url` varchar(128) DEFAULT NULL COMMENT '友情链接url',
  `hl_is_show` tinyint(4) DEFAULT NULL COMMENT '是否显示',
  `hl_remark` varchar(256) DEFAULT NULL COMMENT '友情链接介绍',
  PRIMARY KEY (`hl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `hsblog_link` */

/*Table structure for table `hsblog_system` */

DROP TABLE IF EXISTS `hsblog_system`;

CREATE TABLE `hsblog_system` (
  `hs_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '配置项id',
  `hs_key` varchar(32) DEFAULT NULL COMMENT '配置项键名',
  `hs_value` varchar(128) DEFAULT NULL COMMENT '配置项键值',
  PRIMARY KEY (`hs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `hsblog_system` */

/*Table structure for table `hsblog_tag` */

DROP TABLE IF EXISTS `hsblog_tag`;

CREATE TABLE `hsblog_tag` (
  `ht_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签id',
  `ht_name` varchar(64) DEFAULT NULL COMMENT '标签名',
  `ht_sort` tinyint(4) DEFAULT NULL COMMENT '标签排序',
  PRIMARY KEY (`ht_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `hsblog_tag` */

insert  into `hsblog_tag`(`ht_id`,`ht_name`,`ht_sort`) values (1,'PHP',1),(2,'JS',2),(3,'heredoc和nowdoc',2);

/*Table structure for table `hsblog_test` */

DROP TABLE IF EXISTS `hsblog_test`;

CREATE TABLE `hsblog_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(200) NOT NULL,
  `in_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hsblog_test` */

/*Table structure for table `hsblog_users` */

DROP TABLE IF EXISTS `hsblog_users`;

CREATE TABLE `hsblog_users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_name` varchar(64) NOT NULL COMMENT '登录用户名',
  `user_pw` varchar(128) NOT NULL COMMENT '用户密码',
  `user_email` varchar(128) DEFAULT NULL COMMENT '用户邮箱',
  `user_phone` varchar(32) DEFAULT NULL COMMENT '用户手机',
  `user_avatar` varchar(128) DEFAULT NULL COMMENT '用户头像',
  `user_last_login_ip` varchar(64) DEFAULT NULL COMMENT '最后登录的ip',
  `user_last_login_time` varchar(128) DEFAULT NULL COMMENT '最后登录的时间',
  `user_status` varchar(9) DEFAULT NULL COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `user_type` varchar(9) DEFAULT NULL COMMENT '用户类型，1:admin超级管理员 ;2:会员',
  `user_insert_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册的时间',
  `user_lastip` varchar(128) DEFAULT NULL COMMENT '最新一次登陆的ip',
  `user_lasttime` timestamp NULL DEFAULT NULL COMMENT '最新一次登陆的时间',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `hsblog_users` */

insert  into `hsblog_users`(`u_id`,`user_name`,`user_pw`,`user_email`,`user_phone`,`user_avatar`,`user_last_login_ip`,`user_last_login_time`,`user_status`,`user_type`,`user_insert_time`,`user_lastip`,`user_lasttime`) values (1,'admin','3acf16259def65456fc2a68ab5e10d96',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-09-14 17:49:46','127.0.0.1','2017-03-16 14:48:23');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;