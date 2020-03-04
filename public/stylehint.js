(function($) {
  const namespace = 'stylehint';
  const version = '1.0.0';

  if (typeof jQuery === 'undefined') {
    alert(`${namespace} version ${version} plugin requires jQuery`);
  }

  const defaults = {
    theme: 'light',
    langulage: 'javascript'
  };

  const constants = {
    dataUID: 'data-uid',
    tagsToReplace: {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;'
    },
    cssTemplate: {
      keyword: '<span class="token keyword">$1</span>',
      string: '<span class="token string">$1</span>'
    },
    Regex: {
      functionName: /([a-zA-Z_{1}][a-zA-Z0-9_]+)(?=\()\b/g,
      htmlTags: /(script|input)\b/g
    }
  };

  const langulages = [
    {
      name: 'javascript',
      parser: function(text) {
        const cssTemplate = constants.cssTemplate;
        let html = '';
        const regKeyword = {
          keyword: /(in|of|if|for|while|finally|var|new|function|do|return|void|else|break|catch|instanceof|with|throw|case|default|try|this|switch|continue|typeof|delete|let|yield|const|export|super|debugger|as|async|await|static|import|from|as)\b/gi,
          built_in: /(eval|isNaN|parseFloat|parseInt|escape|Object|Boolean|Error|Number|Math|Date|String|RegExp|Array|ArrayBuffer|JSON|Intl|arguments|require|module|console|window|document|Symbol|Set|Map|Proxy|Promise)\b/gi,
          selector: /(?<=\$\(')(.+)(?='\))\b/g,
          value: /(?<=\=")(.+)(?="\s)\b/g
        };

        const lines = text ? text.split('\n') : [];
        $.each(lines, function(index, line) {
          line = line
            .replace(regKeyword.keyword, cssTemplate.keyword)
            .replace(regKeyword.built_in, cssTemplate.keyword)
            .replace(regKeyword.selector, cssTemplate.keyword)
            .replace(regKeyword.value, cssTemplate.string)
            .replace(constants.Regex.htmlTags, cssTemplate.keyword)
            .replace(constants.Regex.functionName, cssTemplate.string);

          html += line + '\n';
        });

        return html;
      }
    },
    {
      name: 'html',
      parser: function(text) {}
    }
  ];

  const methods = {
    replaceTag: function(tag) {
      return constants.tagsToReplace[tag] || tag;
    },
    getLangulage: function(name) {
      const langulage = langulages.filter(function(x) {
        return x.name === $.trim(name.toLowerCase());
      });
      return langulage ? langulage[0].parser : langulages[0].parser;
    },
    safe_tags_replace: function(str) {
      const $this = this;
      return str.replace(/[&<>]/g, $this.replaceTag);
    }
  };

  const Stylehint = (function() {
    function Stylehint(el, options) {
      const $this = this;
      $this.element = $(el);
      $this.options = $.extend({}, defaults, options);
      $this.data = null;
      $this.init();
    }
    Stylehint.prototype = {
      /**
       * constructor
       * intialize the Stylehint plugin
       * @returns {null}
       */
      init: function() {
        const $this = this;
        const $html = $this.element.html();
        $this.htmlText = $this.safe_tags_replace($html);
        $this.bind();
      },
      bind: function() {
        const $this = this;
        const options = $this.options;
        const parser = $this.getLangulage(options.langulage);

        const text = parser($this.htmlText);
        $this.element.html(text);
      }
    };

    return Stylehint;
  })();

  if ($.extend) {
    $.extend(Stylehint.prototype, langulages, methods);
  }

  if ($.fn) {
    $.fn.stylehint = function(options) {
      this.each(function(index, element) {
        const $element = $(element);
        let data = $element.data(namespace);
        if (!data) {
          $element.attr(constants.dataUID, `${namespace}-${index}`);
          data = new Stylehint(element, options);
          $element.data(namespace, data);
        }
      });

      return this;
    };

    $.fn.stylehint.constractor = Stylehint;
  }
})(jQuery);
