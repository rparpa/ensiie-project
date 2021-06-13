function editArticle(){

    let query = window.location.search;
    let urlParams = new URLSearchParams(query);

    let id = urlParams.get('id');
    console.log('/edition.php?id=' + id);
    window.location = '/edition.php?id=' + id;
}

function unlock(id){
    let current = $("#section" + id);
    
    if(current.prop('disabled') == undefined){
        current.prop('disabled', true);
    }

    let isDisabled = current.prop('disabled');
    if(isDisabled){
        current.prop("disabled", false);
        current.find(".content *").prop("disabled", false);
        current.find("button").prop("disabled", false);
        current.find(".edit").prop("disabled", true);
    }
    else{
        current.prop("disabled", true);
        current.find(".content *").prop("disabled", true);
        current.find("button").prop("disabled", true);
        current.find(".edit").prop("disabled", false);
    }
}

function updateSection(articleId, sectionId){
    let section = $("#section" + sectionId);
    console.log(section);
    let newSection = {};
    newSection.articleID = articleId;
    newSection.sectionID = sectionId;
    newSection.title = section.find(".sectionTitle").val();
    newSection.content = section.find(".sectionContent").val();
    console.log(newSection);
    $.ajax({
        url: 'router.php',
        type: 'POST',
        data: {
            request: "Controller/update_section.php",
            section: newSection
        },
        dataType: 'json'
    })
    .done(function(data){

    });
}