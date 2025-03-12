let enlist = document.querySelector(".enlist");
let rote = document.querySelector(".rote");
let gnt = document.querySelector(".gnt");
let Fop = document.querySelector(".Fop");
let authSection = document.querySelector(".auth-section");

enlist.addEventListener("click", () => {
	Fop.classList.add("moveslider");
	authSection.classList.add("form-section-move");
	rote.classList.add("rote1");
	gnt.classList.add("gnt1");
	
});

gnt.addEventListener("click", () => {
	Fop.classList.remove("moveslider");
	authSection.classList.remove("form-section-move");
	
});
