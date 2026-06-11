var mapContainer = document.getElementById('map'), // 지도를 표시할 div  
    mapOption = { 
        center: new kakao.maps.LatLng(37.48480, 126.92955), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

// 춘식이 마커 이미지 설정 정보
var imageSrc = 'https://jack.dothome.co.kr/jack1/image/chun-sik1.png', // 마커이미지의 주소
    imageSize = new kakao.maps.Size(30, 35), // 마커이미지의 크기
    // 마커가 정확한 좌표 위에 발을 딛고 서 있도록 오프셋 중심점 변경 (가로 절반인 15, 세로 맨 밑인 35)
    imageOption = {offset: new kakao.maps.Point(15, 35)}; 
      
// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);

// [유지] 지도 클릭 시 쌓이는 마커들을 저장하는 배열
var markers = [];

// [추가] 실시간 현재 위치를 정확히 따라다닐 단 하나의 춘식이 마커
var movingChunsik = null;

// 페이지가 처음 켜졌을 때 신림역 7번출구에 기본 마커 하나를 표시합니다 
addMarker(new kakao.maps.LatLng(37.48480, 126.92955));

// [유지] 지도를 클릭했을때 클릭한 위치에 마커를 추가하도록 지도에 클릭이벤트를 등록합니다
kakao.maps.event.addListener(map, 'click', function(mouseEvent) {        
    addMarker(mouseEvent.latLng);             
});

// 마커를 생성하고 지도위에 표시하는 함수입니다 (클릭용 마커 누적)
function addMarker(position) {
    var marker = new kakao.maps.Marker({
        position: position,
        image: markerImage 
    });
    marker.setMap(map);
    markers.push(marker);
}

// [새로 추가] 현재 위치가 업데이트될 때마다 호출되어 춘식이를 내 위치에 정확히 맞추는 함수
function updateMyLocation(position) {
    // 실시간 춘식이가 아직 생성되지 않았다면 새로 만듭니다.
    if (movingChunsik === null) {
        movingChunsik = new kakao.maps.Marker({
            position: position,
            image: markerImage
        });
        movingChunsik.setMap(map);
    } else {
        // 이미 존재한다면 새로 만들지 않고 위치만 실시간 좌표로 갱신합니다.
        movingChunsik.setPosition(position);
    }
    
    // 화면 중심을 현재 위치로 부드럽게 이동시킵니다.
    map.panTo(position);
}

// 배열에 추가된 마커들을 지도에 표시하거나 삭제하는 함수입니다
function setMarkers(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }       
    // 실시간 내 위치 춘식이도 함께 제어되도록 추가
    if (movingChunsik) {
        movingChunsik.setMap(map);
    }
}

// "마커 보이기" 버튼을 클릭하면 호출되는 함수
function showMarkers() {
    setMarkers(map)    
}

// "마커 감추기" 버튼을 클릭하면 호출되는 함수
function hideMarkers() {
    setMarkers(null);    
}