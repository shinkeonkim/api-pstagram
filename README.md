# api 명세 (기능단위)
Header : 'Bearer {java web token}'

## 피드
> ./review
- 리뷰 수정 @POST
- 리뷰 삭제 @DELETE
- 리뷰 업로드 @PUT
- 리뷰 조회 @GET
> ./review?page=10&item=5  @GET
> ./review?page=10&item=5&keyword="삼각김밥" @GET
> ./review/user/{userId}
> ./review/{reviewId} @GET
> ./review/cate/{cateId} @GET

## 사용자
- 프로필 수정 : 사진, 이름
- 프로필 조회 : id, 사진, 이름
> ./profile/lookup.php
- (프로필 삭제) 탈퇴 불가능 관리자 문의바람

## 카테고리
- 카테고리 조회 :
> ./cate? @GET 전체조회
> ./cate/{cateId} @GET 카테고리















# db 테이블 설계
## review
__     |열         |데이터 유형         |NULL?    |기본값    |Extra                     |
|:-----|:----------:|:----------------:|:-------:|:-------:|:------------------------:|
|PK    |review_id   | UNSIGNED int(12) |NOT NULL |         |AUTO increasement     |
|FK    |user_id     | UNSIGNED int(12) |NOT NULL |         | Foreign Key        |
|      |content     | text             |NOT NULL |         |         |
|      |hashtag     | text             |         |         |         |
|      |photo_url   | text             |NOT NULL |         |         |
|FK    |category_id | UNSIGNED int(12) |NOT NULL |         |         |
|      |product_name| (자료 추가)        |NOT NULL |         |         |
|      |rate        | int(10)          |NOT NULL |         |         |
|      |created_at  | DATETIME         |NOT NULL |         |         |
|      |updated_at  | DATETIME         |         |         |         |

## category
__     |열         |데이터 유형          |NULL?   |기본값    |Extra                     |
|:-----|:---------:|:----------------:|:-------:|:-------:|:------------------------:|
|PK    |category_id| UNSIGNED int(12) |NOT NULL | AUTO increasement | primary key    |
|      |content    | text		    |NOT NULL |         |                          |
|      |created_at | DATETIME         |NOT NULL |         |                          |
|      |updated_at | DATETIME         |         |         |                           |  


id | content
|:--------|:--------:|
| 0 | 도시락 |
| 1 | 샌드위치/햄버거 |
| 2 | 주먹밥/김밥 |
| 3 | 튀김류 |
| 4 | 베이커리 |
| 5 | 즉석커피 |
| 6 | 스낵/비스켓 |
| 7 | 빵/디저트 |
| 8 | 껌/초콜릿/캔디 |
| 9 | 아이스크림 |
| 10 | 가공식사 |
| 11 | 안주류 |
| 12 | 식재료 |
| 13 | 음료 |
| 14 | 아이스드링크 |
| 15 | 유제품 |

## like
__     |열         |데이터 유형          |NULL?    |  기본값   |Extra                     |
|:-----|:---------:|:----------------:|:-------:|:-------:|:------------------------:|
|PK    |like_id    | UNSIGNED int(12) |NOT NULL |AUTO increasement | Primary Key        |
|      |review_id  | UNSIGNED int(12) |NOT NULL |         | Foreign Key        |
|      |user_id    | UNSIGNED int(12) |NOT NULL |         | Foreign Key       |
|      |created_at | DATETIME         |NOT NULL |         |         |
|      |updated_at | DATETIME         |         |         |         |










## user

__     |열         |데이터 유형|기본값    |NULL?    |Extra    |
|:-----|:---------:|:----------------:|:-------:|:-------:|:------------------------:|
|PK    |user_id    | UNSIGNED int(12) |NOT NULL |         | AUTO increasement        |
|      |profile_url| text             |NOT NULL |         |                          |
|      |email      | VARCHAR(30)      |NOT NULL |         |         |
|      |username   | VARCHAR(50)      |NOT NULL |         |         |
|      |password   | VARCHAR(100)     |NOT NULL |         |         |
|      |web_token  | VARCHAR(300)     |NOT NULL |         |         |
|      |push_token | VARCHAR(200)     |         |         |         |
|      |created_at | DATETIME         |NOT NULL |         |         |
|      |updated_at | DATETIME         |         |         |         |
|      |google_token| text            |         |         |         |
|      |register_from| VARCHAR(50) ||||

