
function deleteJob() {
    const jobForm = document.querySelector(".createJobForm");
    const deleteForm = document.querySelector(".deleteJob");
    deleteForm.classList.remove("hide");
    jobForm.classList.add("hide")
}

function cancelDelete() {
    const jobForm = document.querySelector(".createJobForm");
    const deleteForm = document.querySelector(".deleteJob");
    jobForm.classList.remove("hide");
    deleteForm.classList.add("hide")
}