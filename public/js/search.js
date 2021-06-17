function autocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        a.setAttribute("onclick", "loadArticleByTitle()");
        this.parentNode.appendChild(a);
        let re = new RegExp(".*" + val.toUpperCase() + ".*");
        re.ignoreCase = true;
        for (i = 0; i < arr.length; i++) {
          if(re.test(arr[i])){
            b = document.createElement("DIV");
            let pos = 0;
            for(let x = 0 ; x < arr[i].length && stop; x++){
              if(re.test(arr[i].substr(pos, val.length))){
                break;
              }
              pos += 1;
            }
            b.innerHTML = arr[i].substr(0, pos);
            b.innerHTML += "<strong>" + arr[i].substr(pos, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(pos + val.length);
            b.innerHTML += "<input type='hidden' id='search_value' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e) {
                inp.value = this.getElementsByTagName("input")[0].value;
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
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
      x[currentFocus].style.backgroundColor = "#4998a7";
      x[currentFocus].style.color = "#ffffff";
      $("#SearchArticle").val(x[currentFocus].getElementsByTagName("input")[0].value)
    }
    function removeActive(x) {
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
        x[i].style.backgroundColor = "#ffffff";
        x[i].style.color = "#000000";
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
        console.log(dataA)
    });
    return dataA;
}

function loadArticleByTitle() {
    title = $('#SearchArticle').val();
    data = searchByTitle(title);
    loadAllArticle(data);
}