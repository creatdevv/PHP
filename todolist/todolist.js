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