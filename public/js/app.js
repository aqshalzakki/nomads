/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

// require('./bootstrap');
// window.Vue = require('vue');
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// const app = new Vue({
//     el: '#app',
// });
// ishan.js
(function collapseMenu() {
  var openMenus = document.querySelectorAll('.open-collapse-menu');
  openMenus.forEach(function (openMenu) {
    var trigger = openMenu.dataset.collapsetrigger;
    var collapseMenu = document.querySelector(trigger);
    var menuHeight = collapseMenu.getBoundingClientRect().height;
    var icon = openMenu.lastElementChild; // Set default height to 0

    collapseMenu.style.height = menuHeight + 'px';
    collapseMenu.style.overflow = 'hidden';
    openMenu.addEventListener('click', function (e) {
      e.preventDefault();

      if (collapseMenu.getBoundingClientRect().height == 0) {
        collapseMenu.style.height = menuHeight + 'px';
        icon.style.transform = 'rotate(0deg)';
      } else {
        collapseMenu.style.height = '0px';
        icon.style.transform = 'rotate(-180deg)';
      }
    });
  });
})(); // Preview image 


(function previewImage() {
  var input = document.querySelector('.file-input');

  if (input) {
    var preview = function preview() {
      var fileObject = this.files[0];
      var fileReader = new FileReader();
      fileReader.readAsDataURL(fileObject);

      fileReader.onload = function () {
        var result = fileReader.result;
        var img = document.querySelector('#imageField');
        img.setAttribute('src', result);
      };

      document.querySelector('#fileName').innerHTML = 'Picture Selected.';
    };

    input.addEventListener('change', preview);
  }
})(); // -----------------


(function seePassword() {
  var toggler = document.querySelectorAll('button[data-passwordtarget]');

  if (toggler) {
    toggler.forEach(function (toggle) {
      toggle.addEventListener('click', function (e) {
        e.preventDefault();
        var target = toggle.dataset.passwordtarget;
        var passwordElement = document.querySelector(target);
        var passwordElementType = passwordElement.getAttribute('type');
        var icon = toggle.querySelector('i');

        if (passwordElementType == 'password') {
          passwordElement.setAttribute('type', 'text');
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
        } else {
          passwordElement.setAttribute('type', 'password');
          icon.classList.add('fa-eye');
          icon.classList.remove('fa-eye-slash');
        }
      });
    });
  }
})();

(function checkPassword() {
  var currentPassword = 'abah1234';
  var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  if (csrf && currentPassword) {
    fetch('http://127.0.0.1:8000/profile/password/check', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrf
      },
      body: JSON.stringify({
        currentPassword: currentPassword
      })
    }).then(function (response) {
      return response.json();
    }).then(function (response) {
      console.log(response);
    });
  }
})();

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\user\Desktop\projects\nomads\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\Users\user\Desktop\projects\nomads\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });