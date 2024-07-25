<!-- Hộp thoại bật lên -->
 <!--Để xác nhận hoặc hủy hành động xóa một mục -->
<div class="modal-overlay" id="myModal">
    <div class="modal-wrapper">
        <div class="modal-container">
            <h5 class="text-center pt-3 m-0">
                Delete item?
            </h5>
            <p class="text-center py-2 mb-1">You cannot undo this action</p>
            <div class="modal-controls">
                <a id="ok-btn" class="modal-control-btn text-center">OK</a>
                <button class="modal-control-btn cancel-btn" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes zoomIn {
        from {
            transform: scale(0.5);
        }

        to {
            transform: scale(1);
        }
    }

    .modal-overlay {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
    }

    .modal-wrapper {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-container {
        overflow: hidden;
        width: 320px;
        margin: 0px auto;
        background-color: white;
        border-radius: 14px;
        animation: zoomIn linear 0.3s;
    }

    .modal-controls {
        border-top: 0.5px solid #ccc;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-control-btn {
        width: 100%;
        font-weight: 500;
        background-color: transparent;
        border: 0;
        box-shadow: none;
        cursor: pointer;
        font-size: 16px;
        color: #007aff;
        padding: 12px 0;
        outline: none;
        text-decoration: none;
        transition: all ease 0.3s;
    }

    .modal-controls a {
        color: #ff0000;
        border-right: 0.5px solid #ccc;
    }

    .modal-control-btn:hover {
        background-color: #ddd;
    }
</style>