
function deleteJob() {
    const jobForm = document.querySelector(".create-job-form");
    const deleteForm = document.getElementById("delete-job");
    deleteForm.classList.remove("hide");
    jobForm.classList.add("hide")
}

function restoreJob() {
    const jobForm = document.querySelector(".create-job-form");
    const restoreForm = document.getElementById("restore-job");
    restoreForm.classList.remove("hide");
    jobForm.classList.add("hide")
}

function cancelDelete() {
    const jobForm = document.querySelector(".create-job-form");
    const deleteForm = document.getElementById("delete-job");
    jobForm.classList.remove("hide");
    deleteForm.classList.add("hide")
}

function cancelRestore() {
    const jobForm = document.querySelector(".create-job-form");
    const restoreForm = document.getElementById("restore-job");
    jobForm.classList.remove("hide");
    restoreForm.classList.add("hide")
}

function cancelCreate() {
    const jobForm = document.querySelector(".create-job-form");
    const cancelForm = document.getElementById("cancel-create");
    jobForm.classList.add("hide");
    cancelForm.classList.remove("hide")
}

function cancelCancel() {
    const jobForm = document.querySelector(".create-job-form");
    const cancelForm = document.getElementById("cancel-create");
    jobForm.classList.remove("hide");
    cancelForm.classList.add("hide")
}