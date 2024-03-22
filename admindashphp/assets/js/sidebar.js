function openSection(sectionName) {
    var sections = document.getElementsByClassName("section");
    for (var i = 0; i < sections.length; i++) {
        if (sections[i].id === sectionName) {
            sections[i].style.display = "block";
        } else {
            sections[i].style.display = "none";
        }
    }
}


function openSection(sectionName) {
var homeContent = document.getElementById("homeContent");
var addScrapsContent = document.getElementById("addScrapsContent");
var scrapRequestContent = document.getElementById("scrapRequestContent");
var feedbackContent = document.getElementById("feedbackContent");

if (sectionName === "home") {
    homeContent.style.display = "block";
    addScrapsContent.style.display = "none";
    scrapRequestContent.style.display = "none";
    feedbackContent.style.display = "none";
} else if (sectionName === "add-scraps") {
    homeContent.style.display = "none";
    addScrapsContent.style.display = "block";
    scrapRequestContent.style.display = "none";
    feedbackContent.style.display = "none";
} else if (sectionName === "scrap-request") {
    homeContent.style.display = "none";
    addScrapsContent.style.display = "none";
    scrapRequestContent.style.display = "block";
    feedbackContent.style.display = "none";
} else if (sectionName === "feedback") {
    homeContent.style.display = "none";
    addScrapsContent.style.display = "none";
    scrapRequestContent.style.display = "none";
    feedbackContent.style.display = "block";
}
}