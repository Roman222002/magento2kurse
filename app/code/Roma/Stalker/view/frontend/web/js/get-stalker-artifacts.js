/**
 * @api
 */
define([
    'jquery',
    'mage/storage',
    'mage/url',
    'mage/template',
    'text!Roma_Stalker/template/my-artifacts.html',
    'domReady!'
], function ($, storage, url, mageTemplate, stalkerArtifactsTemplate) {
    'use strict';

    $.widget('roma.getStalkerArtifacts', {
        options: {
            serviceUrl: 'rest/all/V1/test/artifacts/service/:stalkerId',
            stalkerId: 0,
            userName: 'User\'s',
            artifactsTemplate: stalkerArtifactsTemplate,
            container: '#artifacts-container',
        },

        _create: function () {
            var self = this;
            console.log('UserId: "' + this.options.stalkerId + '"');
            console.log('AjaxUrl: "' + this.getAjaxUrl(this.options.serviceUrl, this.options.stalkerId) + '"');
            $(this.element).on('click', function (event) {
                event.preventDefault();
                if (self.options.stalkerId > 0) {
                    self.renderStalkerArtifacts($(this));
                } else {
                    self.renderNoArtifactsAnswer();
                }
            });
        },

        renderStalkerArtifacts: function(element) {
            var self = this;
            var userId = this.options.stalkerId;
            var fullUrl = this.getAjaxUrl(this.options.serviceUrl, userId);
            storage.get(
                fullUrl, false
            ).done(function (response) {
                console.log(response);
                var container = $(document).find(self.options.container);
                var template = self.options.artifactsTemplate;
                var options = {
                    artifacts: response,
                    hrefMore: element.attr('href'),
                    userName: self.options.userName
                };
                var htmlToInsert = mageTemplate(template, options);
                container.hide();
                container.empty();
                container.html(htmlToInsert);
                container.animate({
                    opacity: 1,
                    width: "show"
                }, 250, function() {
                    container.show();
                });
                self.initClickOnCloseButton(container);
            }).fail(function (response) {
                console.log(response);
            });
        },

        initClickOnCloseButton: function(container)
        {
            container.find('.close').off('click').on('click', function (event) {
                event.preventDefault();
                container.animate({
                    opacity: 0.25,
                    width: "hide"
                }, 500, function() {
                    container.hide();
                });
            });
        },

        renderNoArtifactsAnswer: function() {

        },

        getAjaxUrl: function (serviceUrl, stalkerId) {
            var ajaxUrl = serviceUrl.replace(":stalkerId", stalkerId);
            url.setBaseUrl(BASE_URL);
            return url.build(ajaxUrl)
        }
    });

    return $.roma.getStalkerArtifacts;
});