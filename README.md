# PHP + Laravel 雞排聯盟API實作: 前言

##  起心動念
由於筆者本身很喜歡吃雞排
基本上可以說把家裡、公司附近的雞排店都吃盡了
但由於店家太多、特色又各有不同
價格的落差更是極大 (最近很流行"開源社"的35元雞排吶)
對於一個初入雞排的饕客來說是相當大的困擾
所以有了個想法，要來建立一個滿足雞排饕客的API

## 初步可以達到的功能

1. 建雞排店家資料庫 (有店名、價位、位置、口位、特色的欄位)
2. 搜索排序 (如: 離我最近、價格最低、評價最好、綜合評價)
3. 會員機制 (權限管理、評價管理)
4. 新聞推播 (最新店家、海外feedback)
5. 我的最愛


## 三大步驟
一、產生table及可供操作的物件 (Object)
二、可操作物件的動作 (Action): CRUD
三、權限驗證機制

## 使用工具/環境
1. Local 環境: Valet
2. DB: MySQL & Sequel Pro
3. Editor: PhpStorm

## 參考資料
1. 安裝 Laravel: https://laravel.com/docs/6.x/installation
2. Valet: https://laravel.com/docs/6.x/valet

## 系列文章
最後附上系列文章
1. [PHP + Laravel 雞排聯盟API實作: 前言](https://growingdna.com/chickenfilletaffiliate-api-preface/)
2. [PHP + Laravel 雞排聯盟API實作: 產出 table 及可供操作的物件](https://growingdna.com/chickenfilletaffiliate-api-createmodel/)
3. [PHP + Laravel 雞排聯盟API實作: CRUD 增刪改查](https://growingdna.com/chickenfilletaffiliate-api-crud)
