document.addEventListener('DOMContentLoaded', function() {
    const addButton = document.getElementById('addButton');
    const deleteButton = document.getElementById('deleteButton');
    const studentList = document.getElementById('studentList');
  
    addButton.addEventListener('click', function() {
      agregarEstudiante();
    });
  
    deleteButton.addEventListener('click', function() {
      eliminarEstudiante();
    });
  
    function agregarEstudiante() {
      const input = document.getElementById('studentInput');
      const studentName = input.value.trim();
  
      if (studentName !== '') {
        const listItem = document.createElement('li');
        const span = document.createElement('span');
        span.textContent = studentName;
        listItem.appendChild(span);
        studentList.appendChild(listItem);
        input.value = '';
      }
    }
  
    function eliminarEstudiante() {
      const listItems = studentList.getElementsByTagName('li');
      if (listItems.length > 0) {
        studentList.removeChild(listItems[listItems.length - 1]);
      }
    }
  });
  
  
  