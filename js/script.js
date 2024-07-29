
function showTable(tableId) {
    // Hide all tables
    let tables = document.querySelectorAll('.table');
    tables.forEach(function (table) {
        table.style.display = 'none';
    });

    let selectedTable = document.getElementById(tableId);
    if (selectedTable) {
        selectedTable.style.display = 'table';
    }
};



function addClick(btn) {
    btn.addEventListener('click', () =>{
        let tableId = btn.getAttribute('data-table-id');

        showTable(tableId);
    })
}

let allBtn = document.querySelectorAll(".btndiv button");


allBtn.forEach(addClick);

// show first table by default
showTable('table1');