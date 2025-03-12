let enlist = document.querySelector(".enlist");
let gnt = document.querySelector(".gnt");
let rote = document.querySelector(".rote");
let Fop = document.querySelector(".Fop");
let authSection = document.querySelector(".auth-section");

gnt.addEventListener("click", () => {
	Fop.classList.add("moveslider");
	authSection.classList.add("form-section-move");
	rote.classList.add("rote1");
	enlist.classList.add("enlist1");
});

enlist.addEventListener("click", () => {
	Fop.classList.remove("moveslider");
	authSection.classList.remove("form-section-move");
	
	
});
