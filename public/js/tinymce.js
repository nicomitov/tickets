// TINYMCE
var editor_config = {
    path_absolute : "/",
    selector: "#tiny",
    branding: false,
    insertdatetime_formats: ["%d.%m.%Y", "%d.%m.%Y / %H:%M", "%Y-%m-%d", "%Y-%m-%d / %H:%M", "%H:%M"],
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc codemirror'
    ],
    toolbar: "styleselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | link insertfile image media | prettify code",
    templates: [
    {title: 'Table_Bordered', content: '<p>&nbsp;</p><table class="table table-striped table-bordered table-hover table-sm"><thead><tr class="active"><th colspan="50"><strong>TITLE</strong></th></tr><tr class="active"><th><strong>#</strong></th><th><strong>COL1</strong></th><th><strong>COL2</strong></th></tr></thead><tbody><tr><td>1.</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>2.</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>3.</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><p>&nbsp;</p>'}
    ],
    codemirror: {
        indentOnInit: true, // Whether or not to indent code on init.
        path: 'codemirror', // Path to CodeMirror distribution
        config: {           // CodeMirror config object
            mode: 'application/x-httpd-php',
            lineNumbers: true
        },
        jsFiles: [          // Additional JS files to load
            'mode/clike/clike.js',
            'mode/php/php.js'
        ]
    },
    setup : function(ed) {
    // Add a custom button
    ed.addButton('prettify', {
        title: 'Prettify',
        image: tinymce.baseURL + '/plugins/code.png',
        onclick: function() {
            // Add your own code to execute something on click
            ed.focus();
            ed.selection.setContent('<pre class="prettyprint linenums" style="border: 1px solid #DDD;">' + ed.selection.getContent() + '</pre><p>&nbsp;</p>');
        }
    });
    },
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
};

tinymce.init(editor_config);
