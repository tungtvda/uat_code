/*
 * @Author: kevin
 * @Date:   2016-04-08 17:04:58
 * @Last Modified by:   kevin
 * @Last Modified time: 2016-08-02 15:10:52
 */

var lnv = lnv || {};

(function() {
    function Dialog() {
        this.cfg = {

  // dialog content
  content: '',

  // dialog title
  title: '',


  // text for alert button
  alertBtnText: 'Okey',

  // alert callback
  alertHandler: null,

  // text for confirm button
  confirmBtnText: 'Confirm',

  // confirm callback
  confirmHandler: null,

  // text for cancel button
  cancelBtnText: 'Cancel',

  // text for cancel button
  iconBtnText: '',

  // cancel callback
  cancelHandler: null

};
        this.handlers = {};
    };
    Dialog.prototype = {
        render: function() {
            var footerContent = "";
            switch (this.cfg.type) {
                case "alert":
                    footerContent =
                        '<a class="lnv-btn-dialog primary alert-btn" href="javascript:;">' + this.cfg.alertBtnText + '</a>';
                    break;
                case "confirm":
                    footerContent =
                        '<a class="lnv-btn-dialog default cancel-btn" href="javascript:;"><i class="fa fa-remove"></i> ' + this.cfg.cancelBtnText + '</a>' +
                        '<a class="lnv-btn-dialog primary confirm-btn" href="javascript:;">' + this.cfg.confirmBtnText + '</a>';
                    break;
            }
            this.boundingBox = $(
                '<div id="dialog" class="lnv-dialog-' + this.cfg.type + '">' +
                '<div class="lnv-mask"></div>' +
                '<div class="lnv-dialog">' +
                '<div style=";font-size: 17px;color: #669fc7;padding: 6px " class="lnv-dialog-hd widget-header-confirm">'+this.cfg.iconBtnText+' <strong class="lnv-dialog-title">' + this.cfg.title + '</strong></div>' +
                '<div style="padding-top: 5px;    padding-bottom: 5px;" class="lnv-dialog-bd alert-info">' + this.cfg.content + '</div>' +
                '<div style="text-align: center" class="lnv-dialog-ft">' + footerContent + '</div>' +
                '</div>' +
                '</div>');

            $("body").append(this.boundingBox);
            this.handlers = {};
            this.bind();
        },
        bind: function() {
            var that = this;

            this.boundingBox.on("click", '.alert-btn', function() {
                that.fire('alert');
                that.destroy();
            }).on("click", '.cancel-btn', function() {
                that.fire('cancel');
                that.destroy();
            }).on("click", '.confirm-btn', function() {
                that.fire('confirm');
                that.destroy();
            })

            if (this.cfg.alertHandler) {
                this.on('alert', this.cfg.alertHandler)
            }
            if (this.cfg.confirmHandler) {
                this.on('confirm', this.cfg.confirmHandler)
            }
            if (this.cfg.cancelHandler) {
                this.on('cancel', this.cfg.cancelHandler)
            }
        },
        alert: function(cfg) {
            $.extend(this.cfg, cfg, { type: "alert" });
            this.render();
            return this;
        },
        confirm: function(cfg) {
            $.extend(this.cfg, cfg, { type: "confirm" });
            this.render();
            return this;
        },
        destroy: function() {
            this.boundingBox.remove();
        },
        on: function(type, handler) {
            if (typeof this.handlers[type] == 'undefined') {
                this.handlers[type] = [];
            }
            this.handlers[type].push(handler);
            return this;
        },
        fire: function(type, data) {
            if (this.handlers[type] instanceof Array) {
                var handlers = this.handlers[type];
                for (var i = 0, len = handlers.length; i < len; i++) {
                    handlers[i](data);
                }
            }
        }
    }

    lnv.alert = function(cfg) {
        return new Dialog().alert(cfg);
    };

    lnv.confirm = function(cfg) {
        return new Dialog().confirm(cfg)
    };

})()
