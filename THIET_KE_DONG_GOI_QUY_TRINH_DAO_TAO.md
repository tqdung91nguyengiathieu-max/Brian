# BẢN THIẾT KẾ & QUY TRÌNH ĐÓNG GÓI WEBSITE ĐÀO TẠO NỘI BỘ (NEXTGEN FOREX ACADEMY BLUEPRINT)

> **MỤC ĐÍCH TÀI LIỆU:**  
> Đây là bản đặc tả kỹ thuật, kiến trúc và quy trình toàn diện để xây dựng một nền tảng website đóng gói kiến thức, bài giảng đào tạo thực chiến (cho Khách hàng và Đối tác IB).  
> **Khi cần tái tạo lại website này hoặc tạo một website tương tự:** Chỉ cần yêu cầu AI đọc tài liệu này, AI sẽ tự động sinh mã nguồn, dựng lại toàn bộ cấu trúc giao diện, dữ liệu JSON, logic phát video, bảo mật và hướng dẫn triển khai lên Vercel/GitHub từ A đến Z.

---

## PHẦN 1: TRIẾT LÝ THIẾT KẾ & ĐỊNH VỊ NỀN TẢNG

1. **Tôn chỉ nội dung (Modest & Authentic):**
   - Không sử dụng ngôn từ "chuyên gia", "bậc thầy làm giàu", không thương mại hóa hay bán khóa học.
   - Định vị là: **Hệ Thống Đóng Gói Bài Giảng & Chia Sẻ Kinh Nghiệm Thực Chiến Nội Bộ** dành cho đối tác (IB) và cộng đồng khách hàng đồng hành.
   - Tôn chỉ: Khiêm tốn, bảo vệ vốn, kỷ luật, chia sẻ bài học thực tế từ thị trường.

2. **Cấu trúc phân luồng học viên:**
   - **Luồng 1 (Dành cho Khách hàng / Trader):** Lộ trình từ tư duy nền tảng (Trader Mindset), thuật ngữ thị trường, phân tích cấu trúc giá (Market Structure), thực chiến quản trị lệnh và kỷ luật quản lý vốn.
   - **Luồng 2 (Dành cho Đối tác IB & Leader):** Đóng gói quy trình định vị thương hiệu cá nhân, tạo phễu chia sẻ kiến thức chuẩn mực, tư vấn và giữ chân khách hàng bền vững.

3. **Cơ chế truy cập:**
   - Các buổi thực chiến mở đầu: Gắn nhãn **`🔓 ĐÃ MỞ KHÓA`** (không dùng từ "Xem thử FREE").
   - Các học phần chuyên sâu đóng gói tiếp theo: Gắn nhãn **`🔒 KHÓA`**.
   - Không để các nút kêu gọi nạp tiền, tư vấn bán hàng lộ liễu.

4. **Tuyên bố Miễn trừ trách nhiệm (Legal Disclaimer):**
   - Đặt nổi bật ở chân trang (Footer): Nêu rõ nội dung chỉ nhằm mục đích đào tạo nội bộ và chia sẻ kinh nghiệm, không phải lời khuyên đầu tư tài chính, học viên tự chịu trách nhiệm với quyết định cá nhân.

---

## PHẦN 2: CẤU TRÚC KIẾN TRÚC THƯ MỤC DỰ ÁN

```text
project-root/
│
├── index.html                   # Trang chủ: Tổng quan 2 luồng đào tạo, thống kê, bài học tiêu điểm
├── course.html                  # Trang chi tiết khóa học: Lộ trình Module Accordion, trạng thái Khóa/Mở
├── learn.html                   # Phòng học LMS: Video Player (YouTube/MP4), Sidebar Playlist, Tóm tắt Markdown
├── post.html                    # Template bài viết tin tức / nhận định
├── style.css                    # CSS hệ thống: Dark LMS theme, Vàng Gold, Glassmorphism, Mobile Menu
├── build.js                     # Script build tĩnh (copy dist, tạo SEO metadata động cho từng bài)
├── vercel.json                  # Cấu hình rewrite & build trên Vercel
├── netlify.toml                 # Cấu hình dự phòng Netlify
│
├── admin/                       # Hệ thống Quản trị không dùng Database (Decap/Netlify CMS)
│   ├── index.html               # Trang CMS tải Netlify Identity & Decap CMS CDN
│   └── config.yml               # Cấu hình Git-Gateway, schema khóa học, bài giảng và video
│
├── assets/                      # Tài nguyên tĩnh
│   ├── images/
│   │   ├── logo-nextgen.png     # Logo thương hiệu
│   │   └── uploads/             # Ảnh bìa bài học (buoi1, buoi2, buoi3...)
│
└── content/                     # Cơ sở dữ liệu tĩnh dạng Flat JSON
    ├── courses/
    │   ├── forex-trader.json    # Dữ liệu Khóa Trader (Lộ trình chi tiết + Video thực chiến)
    │   └── forex-ib.json        # Dữ liệu Khóa IB Forex (Lộ trình đào tạo đối tác)
    └── videos/                  # Dữ liệu playlist video bổ trợ
```

---

## PHẦN 3: HỆ THỐNG GIAO DIỆN & STYLE GUIDE (CSS DESIGN SYSTEM)

### 1. Bảng màu chủ đạo (LMS Dark Theme with Gold Accents):
- **Màu nền chính (Background):** `#0b0f19` (Đen xanh đậm công nghệ).
- **Màu nền thẻ card/khung (Card Dark):** `#111827` và `#131b2e`.
- **Đường viền ngăn cách (Border):** `#1e293b` và viền vàng kim mạ mờ `rgba(245, 158, 11, 0.3)`.
- **Màu điểm nhấn (Gold Gradient Accent):**
  - Gradient nút bấm: `linear-gradient(135deg, #f59e0b 0%, #d97706 100%)`.
  - Gradient hover: `linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%)`.
- **Màu chữ:**
  - Tiêu đề & nội dung chính: `#ffffff`.
  - Chữ phụ / mô tả: `#94a3b8` / `#cbd5e1`.
  - Nhãn cảnh báo / Highlight: `#f59e0b`.
  - Nhãn đã mở khóa: Xanh lá viền đậm `rgba(34, 197, 94, 0.2)` chữ `#4ade80`.
  - Nhãn khóa: Đỏ đậm viền `rgba(239, 68, 68, 0.2)` chữ `#f87171`.

### 2. Header Navigation Glassmorphism & Capsule Pills:
- **Header cố định (Sticky Header):** Sử dụng `backdrop-filter: blur(16px)` với hiệu ứng đổ bóng mạ vàng kim phát sáng.
- **Menu điều hướng:** Cụm Navigation Capsule Pill (`nav-pill-container`) bo tròn 99px, thẻ đang chọn được bọc vàng kim.
- **Mobile Responsive Drawer:** Trên điện thoại, menu tự thu vào nút Toggle Hamburger vàng kim; khi bấm xổ ra menu cảm ứng to rõ, dễ thao tác.

---

## PHẦN 4: CÁC TÍNH NĂNG KỸ THUẬT CỐT LÕI (TECHNICAL FEATURES)

### 1. Lối vào Quản trị Bí Mật (Secret Triple-Click Admin Shortcut)
- **Vấn đề:** Khách hàng hoặc học viên vào web không nên thấy nút "Quản trị" hay "CMS", tránh tạo cảm giác website đang xây dựng hoặc bị tò mò.
- **Giải pháp:** Ẩn 100% nút Quản trị trên thanh menu.
- **Cơ chế hoạt động:** Nhấp liên tiếp **3 lần** trong vòng 1.2 giây vào **Logo / Tên thương hiệu NextGen Forex Academy** ở góc trên bên trái ➔ Trình duyệt tự động mở trang `/admin/`.
- **Mã nguồn JavaScript chuẩn:**
```javascript
let secretLogoClicks = 0;
let secretLogoTimer = null;

function handleSecretAdminClick(event) {
    secretLogoClicks++;
    if (secretLogoClicks >= 3) {
        if (event && event.preventDefault) event.preventDefault();
        if (event && event.stopPropagation) event.stopPropagation();
        clearTimeout(secretLogoTimer);
        secretLogoClicks = 0;
        window.location.href = '/admin/';
        return false;
    }
    clearTimeout(secretLogoTimer);
    secretLogoTimer = setTimeout(() => {
        secretLogoClicks = 0;
    }, 1200);
}
```

### 2. Trình phát Video Đa Năng trong LMS (`learn.html`)
- **Tự động nhận diện YouTube Video ID:**
  - Hỗ trợ cả link đầy đủ `https://www.youtube.com/watch?v=...`, link rút gọn `https://youtu.be/...`, lẫn ID trực tiếp 11 ký tự (kể cả video Không công khai - Unlisted).
- **Hỗ trợ video MP4 trực tiếp:** Có cơ chế tự động chuyển sang thẻ `<video controls>` nếu có thuộc tính `videoUrl`.
- **Trạng thái Chờ Upload Video (`isPending: true`):**
  - Hiển thị poster bài học và overlay thông báo chuyên nghiệp: *"Video bài giảng đang được biên tập & hoàn thiện"*.
  - Hướng dẫn học viên đọc phần tóm tắt cốt lõi trong lúc chờ video.
- **Trạng thái Bài học bị khóa (`isFree: false`):**
  - Hiển thị màn hình mờ khóa với thông báo liên hệ đối tác bảo trợ/IB để mở quyền học.
- **Trình đọc tóm tắt bài học Markdown:**
  - Dùng thư viện `marked.min.js` để tự động render ghi chú bài học có định dạng tiêu đề, danh sách, checklist từ trường `summaryMarkdown` trong file JSON.

### 3. Cấu trúc Accordion Danh sách bài học (Course Syllabus & Playlist)
- Hiển thị danh sách Module thu gọn/mở rộng mượt mà.
- Tính toán tự động số thứ tự bài học liên tục (01, 02, 03... 28).
- Hiển thị thời lượng bài học (`1:08:44`), nhãn trạng thái và thẻ `Đang xem` (Now playing).
- Cho phép lọc xem theo từng Module qua tham số URL (`?course=forex-trader&module=1&lesson=trader-live-1`).

---

## PHẦN 5: SCHEMA DỮ LIỆU CHUẨN CỦA KHÓA HỌC (`content/courses/*.json`)

Mỗi khóa học được lưu trữ độc lập dưới dạng 1 file JSON chuẩn theo mẫu sau:

```json
{
  "id": "forex-trader",
  "title": "Lộ Trình Nhà Giao Dịch Forex Thực Chiến",
  "subtitle": "Hành trình từ tư duy nền tảng, phân tích kỹ thuật chuẩn xác đến quản lý vốn & hệ thống giao dịch bền vững.",
  "category": "Nhà giao dịch",
  "badge": "Khóa Học Tiêu Điểm",
  "image": "https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?auto=format&fit=crop&w=1200&q=80",
  "level": "Từ Cơ Bản Đến Thực Chiến",
  "studentsCount": "1,250+ Học viên",
  "rating": "4.9/5.0",
  "totalLessons": 28,
  "totalDuration": "21 giờ 45 phút",
  "description": "Chương trình đào tạo toàn diện được đóng gói chuẩn hóa giúp bạn làm chủ thị trường Forex...",
  "modules": [
    {
      "moduleIndex": 1,
      "title": "🔥 Module 3 Buổi Đào Tạo Thực Chiến Mới Nhất (Team NextGen)",
      "lessons": [
        {
          "id": "trader-live-1",
          "title": "Buổi 1: TRADER MINDSET - Từ người mới đến trader chuyên nghiệp",
          "banner": "/assets/images/uploads/buoi1-trader-mindset.jpg",
          "youtubeId": "vg9WZzN4Soo",
          "videoUrl": "",
          "isPending": false,
          "isFree": true,
          "duration": "1:15:00",
          "summaryMarkdown": "### 🎯 Mục tiêu Buổi 1:\n* Định hình tư duy giao dịch chuẩn..."
        },
        {
          "id": "trader-live-2",
          "title": "Buổi 2: Thuật ngữ cơ bản & cấu trúc thị trường",
          "banner": "/assets/images/uploads/buoi2-thuat-ngu-cau-truc-thi-truong.jpg",
          "youtubeId": "2EnmvVI-LYo",
          "videoUrl": "",
          "isPending": false,
          "isFree": true,
          "duration": "1:15:00",
          "summaryMarkdown": "### 🎯 Mục tiêu Buổi 2:\n* Nắm vững toàn bộ thuật ngữ..."
        },
        {
          "id": "trader-live-3",
          "title": "Buổi 3: Thực chiến trade vàng (phương pháp giao dịch hiệu quả)",
          "banner": "/assets/images/uploads/buoi3-thuc-chien-trade-vang.jpg",
          "youtubeId": "W0GTnTmoiwM",
          "videoUrl": "",
          "isPending": false,
          "isFree": true,
          "duration": "1:08:44",
          "summaryMarkdown": "### 🎯 Mục tiêu Buổi 3:\n* Làm chủ đặc tính biến động của Vàng..."
        }
      ]
    },
    {
      "moduleIndex": 2,
      "title": "🎯 Module: Chuyển Giao Chỉ Báo Độc Quyền (Nhà Ga Vàng)",
      "lessons": [
        {
          "id": "indicator-terminal-pro-v6",
          "title": "Chỉ báo Nhà Ga Vàng - TERMINAL PRO V6",
          "banner": "https://img.youtube.com/vi/FxlP-l1NcdQ/mqdefault.jpg",
          "youtubeId": "FxlP-l1NcdQ",
          "videoUrl": "",
          "isPending": false,
          "isFree": true,
          "duration": "Chuyển giao thực chiến",
          "summaryMarkdown": "### 🎯 Nội dung chuyển giao: Chỉ báo Nhà Ga Vàng - TERMINAL PRO V6..."
        }
      ]
    },
    {
      "moduleIndex": 3,
      "title": "Module 1: Khai Mở Tư Duy & Bản Chất Thị Trường FX",
      "lessons": [
        {
          "id": "trader-2-1",
          "title": "Bản Chất Thị Trường Forex & Cách Các Quỹ Lớn Giao Dịch",
          "youtubeId": "9X3l4EcSwNc",
          "isPending": false,
          "isFree": false,
          "duration": "25:30",
          "summaryMarkdown": "### Mục tiêu bài học..."
        }
      ]
    }
  ]
}
```

---

## PHẦN 6: QUY TRÌNH TRIỂN KHAI VÀ DEPLOY (DEPLOYMENT SOP)

### 1. Quản lý mã nguồn với Git & GitHub:
- Mã nguồn được đẩy lên repository GitHub (nhánh `main`).
- Mỗi thay đổi về bài học, video, sửa file JSON chỉ cần `git commit` và `git push` là hệ thống CI/CD tự động cập nhật web trong 10-20 giây.

### 2. Triển khai lên Vercel:
- **Build Command:** `node build.js` (hoặc để trống nếu chạy HTML tĩnh hoàn toàn).
- **Output Directory:** `dist` (hoặc `.` nếu dùng root trực tiếp).
- **Tự động cấp phát HTTPS:** Vercel tự cấp chứng chỉ SSL miễn phí trọn đời.

### 3. Đổi tên miền / Tùy chỉnh URL trên Vercel:
1. Vào **Vercel Dashboard** ➔ Chọn Project ➔ Vào mục **`Settings` (Cài đặt)**.
2. Chọn menu **`Domains` (Tên miền)**.
3. **Nếu đổi subdomain miễn phí:** Bấm **`Edit` (Biên tập)** tại tên miền `.vercel.app` ➔ Nhập tên mới (ví dụ `nextgenforex-academy`) ➔ Tích chọn *"Chuyển hướng tên miền cũ sang tên miền mới"* ➔ Bấm **Save (Cứu)**.
4. **Nếu gắn tên miền riêng (`.com`, `.vn`):** Bấm **`Add Domain` (Thêm mục hiện có)** ➔ Nhập domain ➔ Cấu hình bản ghi DNS:
   - Bản ghi **A**: `@` trỏ về IP `76.76.21.21`
   - Bản ghi **CNAME**: `www` trỏ về `cname.vercel-dns.com`

---

## PHẦN 7: CÂU LỆNH PHỤC HỒI 1-BƯỚC (RESTORATION PROMPT DÀNH CHO BẠN)

> **Khi bạn cần dựng lại trang web này hoặc tạo 1 dự án tương tự, chỉ cần gửi lệnh sau:**
> 
> *"Hãy đọc file `THIET_KE_DONG_GOI_QUY_TRINH_DAO_TAO.md` và tái tạo lại toàn bộ website đóng gói khóa học theo đúng thiết kế, kiến trúc giao diện dark theme gold, dữ liệu JSON, trình phát video LMS, và tính năng triple-click admin bí mật."*

---
*Tài liệu được thiết lập và đóng gói lưu trữ bởi Antigravity AI - Phiên bản chuẩn hóa 1.0.*
