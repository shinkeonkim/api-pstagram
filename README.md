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
- (프로필 삭제) 탈퇴 불가능 관리자 문의바람.

## 카테고리
- 카테고리 조회 :
> ./cate? @GET 전체조회
> ./cate/{cateId} @GET 카테고리

# db 테이블 설계
## food_review
- reviewId(primary)
- userId 
- content
- <b>hashtag</b>
- phtoUrl
- time
- cateId
- 리뷰제품명(string)
- rate

## category
- ceteId(primary)
- content
```
id content
1  삼각김밥
2  라면
3  음료
...
```

## goods
- goodId(primary)
- reviewId
- userId

## users
- userId(primary) int(11)
- profileUrl(string)  
- id varchar(20) 
- username varchar(10)
- password
- web_token
- push_token
