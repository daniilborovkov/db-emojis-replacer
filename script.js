// TODO: Алгоритм получения скриптов
// TODO: Получение скриптов
(function($) {
    $(document).ready(function() {
        // console.log('Ready to work');
        var typed_text = $('#typed_text'),
            output_text = $('#output_text');
        var rest_api_url = '/wp-json/db-dmoji-replace/v1/log?log=';
        console.log(window.php_vars);
        var emojis_t = window.php_vars.replacements,
            emojis_e = window.php_vars.emojis;
        $('#typed_text').keyup(function(event) {
            var text = typed_text.val();
            text = text.replaceArray(emojis_t, emojis_e);
            output_text.val(text);
        });
        // event listener to select text
        $('#btn-to-clipboard').on('click', function() {
            output_text.select();
            var output = output_text.val();
            // $(this).removeClass("run-animation").addClass("run-animation");
            var url = rest_api_url + output;
            $.ajax({
                url: url,
            });
            // copy to clipboard withut focus change
            var el = document.createElement('textarea');
            el.value = output;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            var copy_babble = $('<span></span>').text('Copied');
            $('.btn-wrapper').append(copy_babble);
            copy_babble.addClass('copy');
        })
    })
})(jQuery);
// var replaceString = this;
//     // 1. transform string to array
//     var arr = replaceString.split(' ');
//     // 2. go to each element of array and try to search is this string to replace
//     arr.forEach(function(part, index, theArray) {
//         // to search it create lowercased variable
//         var lowercased = theArray[index].toLowerCase();
//         if (find.indexOf(lowercased) != -1) {
//             var val = replace[find.indexOf(lowercased)];
//             arr[index] = val;
//         }
//     });
//     // 3. replace string
//     replaceString = arr.join(' ');
//     return replaceString;
String.prototype.replaceArray = function(find, replace) {
  var str = this;
  for (var i = 0; i < find.length; i++) {
    str = str.replace(new RegExp("\\b" + find[i] + "\\b", 'ig'), replace[i]);
  }
  return str.substring(2, str.length);
}