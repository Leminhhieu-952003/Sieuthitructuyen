    <script>
        window.onscroll = function () { myFunction() };

        var header = document.getElementById("myNavbar");

        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
        // Xác nhận xóa
        function confirmDelete() {
            // Redirect to delete.php using the dynamically set href
            window.location.href = document.getElementById('ok-btn').href;
        }

        function closeModal() {
            // Close the modal
            document.getElementById('myModal').style.display = 'none';
        }

        // document.getElementById('btnCheckAll').addEventListener('click', () => toggleCheckboxes(true));
        // document.getElementById('btnUncheckAll').addEventListener('click', () => toggleCheckboxes(false));

        // var checkboxAll = document.getElementById('checkboxAll');
        // var checkboxes = document.querySelectorAll('.checkbox');

        // checkboxAll.addEventListener('change', () => checkboxes.forEach(checkbox => checkbox.checked = checkboxAll.checked));
        // checkboxes.forEach(checkbox => checkbox.addEventListener('change', updateCheckboxAllState));

        // function toggleCheckboxes(checked) {
        //     checkboxes.forEach(checkbox => checkbox.checked = checked);
        // }

        // function updateCheckboxAllState() {
        //     checkboxAll.checked = Array.from(checkboxes).every(cb => cb.checked);
        // }
    </script>

    <footer>
        <p class="m-0 py-2">COPYRIGHT © 2024 Sieu Thi Truc Tuyen. All rights reserved.</p>
    </footer>
</body>

</html>