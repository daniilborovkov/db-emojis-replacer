// TODO: Алгоритм получения скриптов
// TODO: Получение скриптов
(function($) {
    $(document).ready(function() {
        // console.log('Ready to work');
        var typed_text = $('#typed_text'),
            output_text = $('#output_text');
        window.emojis_e = ['😇'];
        window.emojis_t = ['angel'];
        $('#typed_text').keyup(function(event) {
            var text = typed_text.val();
            text = text.replaceArray(emojis_t, emojis_e);
            console.log(text)
            output_text.val(text);
        })
    })
})(jQuery);
String.prototype.replaceArray = function(find, replace) {
    var replaceString = this;
    // 1. transform string to array
    var arr = replaceString.split(' ');
    // 2. go to each element of array and try to search is this string to replace
    arr.forEach(function (part, index, theArray) {
      // to search it create lowercased variable
      var lowercased = theArray[index].toLowerCase();
      if (find.indexOf(lowercased) != -1) {
        var val = replace[find.indexOf(lowercased)];
        console.log('val_to_replace', val);
        arr[index] = val;
      }
    });
    console.log('arr', arr);
    // 3. replace string
    replaceString = arr.join(' ');
    return replaceString;
}