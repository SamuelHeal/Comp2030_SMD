
function deleteJob() {
    const jobForm = document.querySelector(".create-job-form");
    const deleteForm = document.querySelector(".delete-job");
    deleteForm.classList.remove("hide");
    jobForm.classList.add("hide")
}

function restoreJob() {
    const jobForm = document.querySelector(".create-job-form");
    const restoreForm = document.querySelector(".restore-job");
    restoreForm.classList.remove("hide");
    jobForm.classList.add("hide")
}

function cancelDelete() {
    const jobForm = document.querySelector(".create-job-form");
    const deleteForm = document.querySelector(".delete-job");
    jobForm.classList.remove("hide");
    deleteForm.classList.add("hide")
}

function cancelRestore() {
    const jobForm = document.querySelector(".create-job-form");
    const deleteForm = document.querySelector(".restore-job");
    jobForm.classList.remove("hide");
    deleteForm.classList.add("hide")
}