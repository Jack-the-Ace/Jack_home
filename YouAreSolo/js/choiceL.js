const stars = document.querySelectorAll('.star');
const submitBtn = document.getElementById('submit-star');
let selectedRating = 0; // 사용자가 선택한 점수를 저장할 변수

stars.forEach(star => {
    // 1. 별을 클릭했을 때의 이벤트
    star.addEventListener('click', () => {
        selectedRating = parseInt(star.getAttribute('data-value'));
        
        // 클릭한 별의 드래그 값 이하인 별들은 채우고(filled), 초과인 별들은 비우기
        stars.forEach(s => {
            const starValue = parseInt(s.getAttribute('data-value'));
            if (starValue <= selectedRating) {
                s.classList.add('filled');
                s.innerText = '★'; // 채워진 별로 변경
            } else {
                s.classList.remove('filled');
                s.innerText = '☆'; // 빈 별로 변경
            }
        });

        // 2. 평점이 선택되었으므로 제출 버튼 활성화
        submitBtn.disabled = false;
        submitBtn.classList.add('active');
    });
});

// 3. 제출 버튼을 눌렀을 때 작동할 이벤트 (테스트용 알림창)
submitBtn.addEventListener('click', () => {
    if (selectedRating > 0) {
        alert(`영숙님에게 별 ${selectedRating}점을 제출했습니다! 💘`);
        // 여기에 나중에 서버로 데이터를 보내는 코드를 작성하시면 됩니다.
    }
});
// [기존 코드 생략] ... 별점 관련 스크립트가 기작성되어 있다고 가정합니다.

// 댓글 관련 요소 가져오기
const replyText = document.getElementById('reply_text');
const submitReplyBtn = document.getElementById('submit_reply');

// 댓글 제출 이벤트 관리
submitReplyBtn.addEventListener('click', () => {
const commentValue = replyText.value.trim();

// 댓글을 입력하지 않고 제출 버튼을 눌렀을 때 예외 처리
if (commentValue === "") {
    alert("댓글 내용을 입력해 주세요! ✍️");
    return;
}

/* 💡 [추후 마이페이지 연동용 핵심 설계]
    현재 페이지에 표시된 상대방의 데이터(닉네임, 이미지 경로)와 
    내가 기록한 점수(selectedRating), 댓글 내용을 하나의 객체로 바인딩합니다.
*/
const targetNickname = document.querySelector('.profile_info .nickname').innerText;
const targetImgSrc = document.querySelector('main img').getAttribute('src');

const historyLog = {
    nickname: targetNickname,
    image: targetImgSrc,
    rating: typeof selectedRating !== 'undefined' ? selectedRating : 0, // 별점 스크립트 변수 연동
    comment: commentValue,
    date: new Date().toLocaleString() // 작성 시간 기록
};

// 임시 확인용 로그 (브라우저 F12 개발자도구 콘솔 창에서 데이터 구조 확인 가능)
console.log("마이페이지로 보낼 저장 데이터:", historyLog);

// 요청하신 알림창 띄우기
alert("댓글이 제출되었습니다. 비매너 댓글 작성 시, 운영진에 의해 패널티가 부여됩니다.");

// 제출 완료 후 입력창 청소
replyText.value = "";
});
document.getElementById('like').onclick = function() {
    location.href = "https://jack.dothome.co.kr/UAS/like.html";
};
