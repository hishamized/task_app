(
    function(){
        document.getElementById('toggleProjectHistory').addEventListener('click', function () {
            const table = document.getElementById('projectHistoryTable');
            if (table.style.display === 'none') {
                table.style.display = 'table';
            } else {
                table.style.display = 'none';
            }
        });
    }
)();
