function autocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener("input", function(e) {
        var arrCopy = [...arr];
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);

        let matching = [];
        // match beging of a word
        let re = new RegExp(val.toUpperCase() + ".*", "i");
        for (i = arr.length - 1 ; i >= 0 && matching.length < 5; i--) {
          if(re.test(arr[i])){
            matching.push(arr[i]);
            arr.splice(i, 1);
          }
        }
        // match in of a title
        re = new RegExp( ".*" + val.toUpperCase() + ".*", "i");
        for(i = arr.length - 1 ; i >= 0 && matching.length < 5; i--) {
          if(re.test(arr[i])){
            matching.push(arr[i]);
            arr.splice(i, 1);
          }
        }
        for (i = matching.length - 1 ; i >= 0; i--){
          b = document.createElement("DIV");
          let pos = 0;
          for(let x = 0 ; x < matching[i].length && stop; x++){
            if(re.test(matching[i].substr(pos, val.length))){
              break;
            }
            pos += 1;
          }
          b.innerHTML = matching[i].substr(0, pos);
          b.innerHTML += "<strong>" + matching[i].substr(pos, val.length) + "</strong>";
          b.innerHTML += matching[i].substr(pos + val.length);
          b.innerHTML += "<input type='hidden' value='" + matching[i] + "'>";
              b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
          
        }
        arr = [...arrCopy];
    });
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          currentFocus++;
          addActive(x);
        } else if (e.keyCode == 38) {
          currentFocus--;
          addActive(x);
        } else if (e.keyCode == 13) {
          e.preventDefault();
          if (currentFocus > -1) {
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      if (!x) return false;
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

function loadSuggestion(){
  let suggestion = [];
  $.ajax({
      url: 'router.php',
      type: 'POST',
      async: false,
      data: {
          request: "Controller/get_article.php",
          to_do: "getTitles"
      },
      dataType: 'json'
  }).done(function (data) {
          suggestion = [];
          data.titles.forEach(e =>{
              suggestion.push(e.title);
          })
  });
  return suggestion;
}

function loadSearch(){
    fetch('template/search.html')
        .then(response => response.text())
        .then(function(data){
            $("#content").append(data);
            autocomplete(document.getElementById("SearchArticle"), loadSuggestion());
        });
}

function searchByTitle(title){
    let dataA;
    $.ajax({
        url: 'router.php',
        type: 'POST',
        async: false,
        data: {
            request: "Controller/get_article.php",
            to_do: "getArticleByTitle",
            title: title
        },
        dataType: 'json'
    }).done(function (data) {
        dataA = data.articles;
    });
    return dataA;
}

function loadArticleByTitle() {
    title = $('#SearchArticle').val();
    data = searchByTitle(title);
    loadAllArticle(data);
}