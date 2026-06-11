var mapContainer = document.getElementById('map'), // 지도를 표시할 div  
    mapOption = { 
        center: new kakao.maps.LatLng(37.48480, 126.92955), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

// 춘식이 마커 이미지 설정 정보
var imageSrc = 'https://jack.dothome.co.kr/jack1/image/chun-sik1.png', // 마커이미지의 주소
    imageSize = new kakao.maps.Size(30, 35), // 마커이미지의 크기
    imageOption = {offset: new kakao.maps.Point(27, 69)}; // 마커의 좌표와 일치시킬 이미지 안에서의 좌표
      
// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);

// 지도에 표시된 마커 객체를 가지고 있을 배열입니다
var markers = [];

// [변경] 페이지가 처음 켜졌을 때 신림역 7번출구에 "춘식이 마커"를 표시합니다 
addMarker(new kakao.maps.LatLng(37.48480, 126.92955));

// 지도를 클릭했을때 클릭한 위치에 마커를 추가하도록 지도에 클릭이벤트를 등록합니다
kakao.maps.event.addListener(map, 'click', function(mouseEvent) {        
    // 클릭한 위치에도 춘식이 마커를 표시합니다 
    addMarker(mouseEvent.latLng);             
});

// 마커를 생성하고 지도위에 표시하는 함수입니다
function addMarker(position) {
    
    // 마커를 생성합니다 (춘식이 이미지를 적용)
    var marker = new kakao.maps.Marker({
        position: position,
        image: markerImage // 춘식이 이미지 등록!
    });

    // 마커가 지도 위에 표시되도록 설정합니다
    marker.setMap(map);
    
    // 생성된 마커를 배열에 추가합니다
    markers.push(marker);
}

// 배열에 추가된 마커들을 지도에 표시하거나 삭제하는 함수입니다
function setMarkers(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }            
}

// "마커 보이기" 버튼을 클릭하면 호출되어 배열에 추가된 마커를 지도에 표시하는 함수입니다
function showMarkers() {
    setMarkers(map)    
}

// "마커 감추기" 버튼을 클릭하면 호출되어 배열에 추가된 마커를 지도에서 삭제하는 함수입니다
function hideMarkers() {
    setMarkers(null);    
}