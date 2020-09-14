this.BX = this.BX || {};
(function (exports) {
	'use strict';

	function _createForOfIteratorHelper(o,allowArrayLike){var it;if(typeof Symbol==="undefined"||o[Symbol.iterator]==null){if(Array.isArray(o)||(it=_unsupportedIterableToArray(o))||allowArrayLike&&o&&typeof o.length==="number"){if(it)o=it;var i=0;var F=function F(){};return {s:F,n:function n(){if(i>=o.length)return {done:true};return {done:false,value:o[i++]}},e:function e(_e){throw _e},f:F}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var normalCompletion=true,didErr=false,err;return {s:function s(){it=o[Symbol.iterator]();},n:function n(){var step=it.next();normalCompletion=step.done;return step},e:function e(_e2){didErr=true;err=_e2;},f:function f(){try{if(!normalCompletion&&it["return"]!=null)it["return"]();}finally{if(didErr)throw err}}}}function _unsupportedIterableToArray(o,minLen){if(!o)return;if(typeof o==="string")return _arrayLikeToArray(o,minLen);var n=Object.prototype.toString.call(o).slice(8,-1);if(n==="Object"&&o.constructor)n=o.constructor.name;if(n==="Map"||n==="Set")return Array.from(o);if(n==="Arguments"||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return _arrayLikeToArray(o,minLen)}function _arrayLikeToArray(arr,len){if(len==null||len>arr.length)len=arr.length;for(var i=0,arr2=new Array(len);i<len;i++){arr2[i]=arr[i];}return arr2}function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function")}}function _defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value"in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}function _createClass(Constructor,protoProps,staticProps){if(protoProps)_defineProperties(Constructor.prototype,protoProps);if(staticProps)_defineProperties(Constructor,staticProps);return Constructor}var Observer=/*#__PURE__*/function(){function Observer(){_classCallCheck(this,Observer);this.subscribers=[];this.eventScope="default";}_createClass(Observer,[{key:"subscribe",value:function subscribe(obj){var _iterator=_createForOfIteratorHelper(this.subscribers),_step;try{for(_iterator.s();!(_step=_iterator.n()).done;){var subscriber=_step.value;if(subscriber==obj)return}}catch(err){_iterator.e(err);}finally{_iterator.f();}this.subscribers.push(obj);}},{key:"unsubscribe",value:function unsubscribe(obj){this.subscribers=this.subscribers.filter(function(subscriber){return subscriber!==obj});}},{key:"notify",value:function notify(eventType,data){var event=this.getEventHandlerName(eventType);this.subscribers.forEach(function(subscriber){return subscriber[event]?subscriber[event](data):false});}},{key:"getEventHandlerName",value:function getEventHandlerName(eventType){eventType=eventType.charAt(0).toUpperCase()+eventType.slice(1);return "".concat(this.eventScope).concat(eventType,"Event")}}]);return Observer}();

	function _typeof(obj){"@babel/helpers - typeof";if(typeof Symbol==="function"&&typeof Symbol.iterator==="symbol"){_typeof=function _typeof(obj){return typeof obj};}else{_typeof=function _typeof(obj){return obj&&typeof Symbol==="function"&&obj.constructor===Symbol&&obj!==Symbol.prototype?"symbol":typeof obj};}return _typeof(obj)}function asyncGeneratorStep(gen,resolve,reject,_next,_throw,key,arg){try{var info=gen[key](arg);var value=info.value;}catch(error){reject(error);return}if(info.done){resolve(value);}else{Promise.resolve(value).then(_next,_throw);}}function _asyncToGenerator(fn){return function(){var self=this,args=arguments;return new Promise(function(resolve,reject){var gen=fn.apply(self,args);function _next(value){asyncGeneratorStep(gen,resolve,reject,_next,_throw,"next",value);}function _throw(err){asyncGeneratorStep(gen,resolve,reject,_next,_throw,"throw",err);}_next(undefined);})}}function _classCallCheck$1(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function")}}function _defineProperties$1(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value"in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}function _createClass$1(Constructor,protoProps,staticProps){if(protoProps)_defineProperties$1(Constructor.prototype,protoProps);if(staticProps)_defineProperties$1(Constructor,staticProps);return Constructor}function _inherits(subClass,superClass){if(typeof superClass!=="function"&&superClass!==null){throw new TypeError("Super expression must either be null or a function")}subClass.prototype=Object.create(superClass&&superClass.prototype,{constructor:{value:subClass,writable:true,configurable:true}});if(superClass)_setPrototypeOf(subClass,superClass);}function _setPrototypeOf(o,p){_setPrototypeOf=Object.setPrototypeOf||function _setPrototypeOf(o,p){o.__proto__=p;return o};return _setPrototypeOf(o,p)}function _createSuper(Derived){var hasNativeReflectConstruct=_isNativeReflectConstruct();return function _createSuperInternal(){var Super=_getPrototypeOf(Derived),result;if(hasNativeReflectConstruct){var NewTarget=_getPrototypeOf(this).constructor;result=Reflect.construct(Super,arguments,NewTarget);}else{result=Super.apply(this,arguments);}return _possibleConstructorReturn(this,result)}}function _possibleConstructorReturn(self,call){if(call&&(_typeof(call)==="object"||typeof call==="function")){return call}return _assertThisInitialized(self)}function _assertThisInitialized(self){if(self===void 0){throw new ReferenceError("this hasn't been initialised - super() hasn't been called")}return self}function _isNativeReflectConstruct(){if(typeof Reflect==="undefined"||!Reflect.construct)return false;if(Reflect.construct.sham)return false;if(typeof Proxy==="function")return true;try{Date.prototype.toString.call(Reflect.construct(Date,[],function(){}));return true}catch(e){return false}}function _getPrototypeOf(o){_getPrototypeOf=Object.setPrototypeOf?Object.getPrototypeOf:function _getPrototypeOf(o){return o.__proto__||Object.getPrototypeOf(o)};return _getPrototypeOf(o)}var OdvaBasket=/*#__PURE__*/function(_Observer){_inherits(OdvaBasket,_Observer);var _super=_createSuper(OdvaBasket);function OdvaBasket(){var _this;_classCallCheck$1(this,OdvaBasket);_this=_super.call(this);_this.eventScope="basket";return _this}_createClass$1(OdvaBasket,[{key:"getCount",value:function(){var _getCount=_asyncToGenerator(/*#__PURE__*/regeneratorRuntime.mark(function _callee(){var response;return regeneratorRuntime.wrap(function _callee$(_context){while(1){switch(_context.prev=_context.next){case 0:_context.next=2;return this.getResponse("getCount",false,{method:"GET"});case 2:response=_context.sent;this.notify("getCount",response);return _context.abrupt("return",response);case 5:case"end":return _context.stop();}}},_callee,this)}));function getCount(){return _getCount.apply(this,arguments)}return getCount}()},{key:"clear",value:function(){var _clear=_asyncToGenerator(/*#__PURE__*/regeneratorRuntime.mark(function _callee2(){var response;return regeneratorRuntime.wrap(function _callee2$(_context2){while(1){switch(_context2.prev=_context2.next){case 0:_context2.next=2;return this.getResponse("clear",false,{method:"GET"});case 2:response=_context2.sent;this.notify("clear",response);return _context2.abrupt("return",response);case 5:case"end":return _context2.stop();}}},_callee2,this)}));function clear(){return _clear.apply(this,arguments)}return clear}()},{key:"addItem",value:function(){var _addItem=_asyncToGenerator(/*#__PURE__*/regeneratorRuntime.mark(function _callee3(productId,quantity){var response;return regeneratorRuntime.wrap(function _callee3$(_context3){while(1){switch(_context3.prev=_context3.next){case 0:_context3.next=2;return this.getResponse("addItem",{productId:productId,quantity:quantity});case 2:response=_context3.sent;this.notify("addItem",response);return _context3.abrupt("return",response);case 5:case"end":return _context3.stop();}}},_callee3,this)}));function addItem(_x,_x2){return _addItem.apply(this,arguments)}return addItem}()},{key:"deleteItem",value:function(){var _deleteItem=_asyncToGenerator(/*#__PURE__*/regeneratorRuntime.mark(function _callee4(productId){var response;return regeneratorRuntime.wrap(function _callee4$(_context4){while(1){switch(_context4.prev=_context4.next){case 0:_context4.next=2;return this.getResponse("deleteItem",{productId:productId});case 2:response=_context4.sent;this.notify("deleteItem",response);return _context4.abrupt("return",response);case 5:case"end":return _context4.stop();}}},_callee4,this)}));function deleteItem(_x3){return _deleteItem.apply(this,arguments)}return deleteItem}()},{key:"changeItemQuantity",value:function(){var _changeItemQuantity=_asyncToGenerator(/*#__PURE__*/regeneratorRuntime.mark(function _callee5(productId,quantity){var response;return regeneratorRuntime.wrap(function _callee5$(_context5){while(1){switch(_context5.prev=_context5.next){case 0:_context5.next=2;return this.getResponse("changeItemQuantity",{productId:productId,quantity:quantity});case 2:response=_context5.sent;this.notify("changeItemQuantity",response);return _context5.abrupt("return",response);case 5:case"end":return _context5.stop();}}},_callee5,this)}));function changeItemQuantity(_x4,_x5){return _changeItemQuantity.apply(this,arguments)}return changeItemQuantity}()},{key:"getResponse",value:function(){var _getResponse=_asyncToGenerator(/*#__PURE__*/regeneratorRuntime.mark(function _callee6(action){var data,config,defaultConfig,_args6=arguments;return regeneratorRuntime.wrap(function _callee6$(_context6){while(1){switch(_context6.prev=_context6.next){case 0:data=_args6.length>1&&_args6[1]!==undefined?_args6[1]:{};config=_args6.length>2?_args6[2]:undefined;defaultConfig={dataType:"json",method:"POST"};config=config||{};config=$.extend(defaultConfig,config);config.url=this.makeApiUrl(action);config.data=config.data||data;_context6.next=9;return $.ajax(config);case 9:return _context6.abrupt("return",_context6.sent);case 10:case"end":return _context6.stop();}}},_callee6,this)}));function getResponse(_x6){return _getResponse.apply(this,arguments)}return getResponse}()},{key:"makeApiUrl",value:function makeApiUrl(action){return "/bitrix/services/main/ajax.php?action=odva:module.api.".concat(this.eventScope,".").concat(action)}}]);return OdvaBasket}(Observer);var basket = new OdvaBasket;

	exports.Basket = basket;

}((this.BX.Odva = this.BX.Odva || {})));
//# sourceMappingURL=main.bundle.js.map
