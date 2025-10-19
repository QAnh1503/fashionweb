
<style>
    /* .counter {
        display: flex;
        align-items: center;
    } */

    .counter input::-webkit-inner-spin-button,
    .counter input::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
        /* Đảm bảo không có khoảng trống */
    }

    .counter input {
        width: 40px;
        border: 0;
        line-height: 30px;
        font-size: 13px;
        text-align: center;
        color: #000;
        -moz-appearance: textfield;
        /* Loại bỏ spinner trên Firefox */
        -webkit-appearance: none;
        /* Loại bỏ spinner trên Chrome, Safari */
        appearance: none;
        /* Loại bỏ kiểu mặc định của trình duyệt cho input (đặc biệt là các input kiểu number hoặc range, làm mất các nút mũi tên tăng/giảm). */
        outline: 0;
    }

    .counter span {
        display: block;
        font-size: 13px;
        /* padding: 0 10px; */
        cursor: pointer;
        color: #fff;
        background-color: #000;
        border-radius: 50%;
        width: 15px;
        height: 17px;
        user-select: none;
        text-align: center;
        line-height: 20px;
        /* Bằng với height */
        box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.3);
        transition: opacity 0.2s ease, transform 0s ease;
    }

    .counter span:active {
        opacity: 0.8;
        transform: scale(0.98);
    }
</style>



<script>
    function increaseCount(a, b) {
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 20) { // Kiểm tra max
            value++;
            input.value = value;
        }
    }

    function decreaseCount(a, b) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
            value = isNaN(value) ? 0 : value;
            value--;
            input.value = value;
        }
    }
</script>