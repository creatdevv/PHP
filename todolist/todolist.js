document.addEventListener("DOMContentLoaded", () => {
    const todobtn = document.querySelector("#todobtn");

    todobtn.addEventListener("click", () => {
        const subject = document.querySelector("#subject");
    if(subject.value == "") {
        alert("할일을 입력해 주세요.");
        subject.focus();            // 빈칸으로 다시~
        return false;
    } 
        document.todoform.submit();         // todoform >> index.php의 form name

    });
});

// 취소선 js
function todoCheck(idx) {
    const multiform = document.querySelector("#multiform");
    multiform.mode.value = "done";
    multiform.idx.value = idx;
    multiform.submit();
}

// 취소선을 취소 js
function todoUnCheck(idx) {
    const multiform = document.querySelector("#multiform");
    multiform.mode.value = "undone";
    multiform.idx.value = idx;
    multiform.submit();
}

//삭제버튼 js
function todoDel(idx) {
    if(confirm('삭제하시겠습니까?')){           // 삭제여부 물어보고 삭제시키기
    const multiform = document.querySelector("#multiform");
    multiform.mode.value = "del";
    multiform.idx.value = idx;
    multiform.submit();
    }
}