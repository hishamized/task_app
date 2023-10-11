(function () {
    const editTaskButton = document.getElementById("editTaskButton");
    const editTaskForm = document.getElementById("editTaskForm");

    editTaskButton.addEventListener("click", function () {
        if (editTaskForm.style.display === "block") {
            editTaskForm.style.display = "none";
        } else {
            editTaskForm.style.display = "block";
        }
    });
})();

(function () {
    // Get the "Assign This Task" button and the assignment form
    const assignTaskButton = document.getElementById("assignTaskButton");
    const assignmentForm = document.getElementById("assignmentForm");

    // Add a click event listener to the "Assign This Task" button
    assignTaskButton.addEventListener("click", function () {
        // Toggle the visibility of the assignment form
        if (
            assignmentForm.style.display === "none" ||
            assignmentForm.style.display === ""
        ) {
            assignmentForm.style.display = "block";
        } else {
            assignmentForm.style.display = "none";
        }
    });
})();
