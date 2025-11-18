# ✅ Konfigurasi Email & Kontak - Gallery Page

## 📋 Perubahan yang Dilakukan

### 1. **Navigation Menu - Hubungi Kami**
**File:** `resources/views/gallery.blade.php`

#### **Link Kontak (Telepon)**
```html
<!-- BEFORE -->
<a href="#" class="nav-dropdown-item">
    <i class="fas fa-phone"></i>
    <span>Kontak</span>
</a>

<!-- AFTER -->
<a href="tel:+622518242411" class="nav-dropdown-item">
    <i class="fas fa-phone"></i>
    <span>Kontak</span>
</a>
```

**Fungsi:**
- Klik akan membuka aplikasi telepon
- Nomor: +62 251 8242411
- Format: `tel:+622518242411`

#### **Link Email**
```html
<!-- BEFORE -->
<a href="#" class="nav-dropdown-item">
    <i class="fas fa-envelope"></i>
    <span>Email</span>
</a>

<!-- AFTER -->
<a href="mailto:info@smkn4bogor.sch.id?subject=Pertanyaan%20tentang%20SMK%20Negeri%204%20Bogor&body=Halo%20SMK%20Negeri%204%20Bogor,%0A%0A" class="nav-dropdown-item">
    <i class="fas fa-envelope"></i>
    <span>Email</span>
</a>
```

**Fungsi:**
- Klik akan membuka aplikasi email default
- Email: info@smkn4bogor.sch.id
- Subject: "Pertanyaan tentang SMK Negeri 4 Bogor"
- Body: "Halo SMK Negeri 4 Bogor,"
- Format: `mailto:email@domain.com?subject=...&body=...`

---

### 2. **Footer Contact Section**

#### **Telepon di Footer**
```html
<!-- BEFORE -->
<strong>Telepon:</strong><br>
(0251) 8242411

<!-- AFTER -->
<strong>Telepon:</strong><br>
<a href="tel:+622518242411" style="color: inherit; text-decoration: none;">
    (0251) 8242411
</a>
```

#### **Email di Footer**
```html
<!-- BEFORE -->
<strong>Email:</strong><br>
info@smkn4bogor.sch.id

<!-- AFTER -->
<strong>Email:</strong><br>
<a href="mailto:info@smkn4bogor.sch.id?subject=Pertanyaan%20tentang%20SMK%20Negeri%204%20Bogor" style="color: inherit; text-decoration: none;">
    info@smkn4bogor.sch.id
</a>
```

---

## 🎯 Cara Kerja

### **Ketika User Klik "Email":**

1. **Desktop:**
   - Membuka aplikasi email default (Outlook, Thunderbird, dll)
   - Email tujuan: info@smkn4bogor.sch.id
   - Subject sudah terisi: "Pertanyaan tentang SMK Negeri 4 Bogor"
   - Body sudah terisi: "Halo SMK Negeri 4 Bogor,"

2. **Mobile:**
   - Membuka aplikasi email (Gmail, Yahoo Mail, dll)
   - Sama seperti desktop, subject dan body sudah terisi

3. **Web Mail:**
   - Jika tidak ada aplikasi email, browser akan membuka web mail
   - User bisa pilih Gmail, Yahoo, dll

### **Ketika User Klik "Kontak":**

1. **Desktop:**
   - Membuka aplikasi telepon (Skype, Teams, dll)
   - Nomor sudah terisi: +62 251 8242411

2. **Mobile:**
   - Membuka aplikasi telepon default
   - Nomor sudah terisi, tinggal tekan call

---

## 📧 Format Mailto URL

### **Basic Format:**
```
mailto:email@domain.com
```

### **With Subject:**
```
mailto:email@domain.com?subject=Subject%20Text
```

### **With Subject and Body:**
```
mailto:email@domain.com?subject=Subject&body=Body%20text
```

### **URL Encoding:**
- Space → `%20`
- Newline → `%0A`
- @ → `%40` (optional)
- & → `%26` (dalam body)

### **Example:**
```html
<a href="mailto:info@smkn4bogor.sch.id?subject=Pertanyaan%20tentang%20SMK&body=Halo,%0A%0ASaya%20ingin%20bertanya%20tentang...">
    Email Kami
</a>
```

---

## 📞 Format Tel URL

### **Basic Format:**
```
tel:+622518242411
```

### **With Country Code:**
```
tel:+62-251-8242411
```

### **Format Options:**
- `tel:+622518242411` ✅ (Recommended)
- `tel:+62-251-8242411` ✅
- `tel:02518242411` ⚠️ (Local only)

---

## 🎨 Styling

### **Inherit Parent Color:**
```html
<a href="mailto:..." style="color: inherit; text-decoration: none;">
    Email Text
</a>
```

**Fungsi:**
- `color: inherit` → Warna mengikuti parent
- `text-decoration: none` → Tidak ada underline
- Terlihat seperti text biasa, tapi clickable

---

## 🧪 Testing

### **Test Email Link:**
1. Buka gallery page
2. Klik menu "Hubungi Kami" → "Email"
3. Aplikasi email akan terbuka
4. Cek subject dan body sudah terisi

### **Test Kontak Link:**
1. Buka gallery page
2. Klik menu "Hubungi Kami" → "Kontak"
3. Aplikasi telepon akan terbuka
4. Nomor sudah terisi

### **Test Footer Links:**
1. Scroll ke footer
2. Klik nomor telepon → Aplikasi telepon terbuka
3. Klik email → Aplikasi email terbuka

---

## 📱 Compatibility

### **Email (mailto:)**
- ✅ Desktop: Outlook, Thunderbird, Apple Mail
- ✅ Mobile: Gmail, Yahoo Mail, Outlook Mobile
- ✅ Web: Gmail Web, Yahoo Web, Outlook Web
- ✅ All modern browsers

### **Phone (tel:)**
- ✅ Mobile: iOS Phone, Android Phone
- ✅ Desktop: Skype, Teams, FaceTime
- ✅ All modern browsers

---

## 🔧 Customization

### **Mengubah Email:**
```html
<!-- Ganti email address -->
<a href="mailto:newemail@domain.com?subject=...">
```

### **Mengubah Subject:**
```html
<!-- Ganti subject -->
<a href="mailto:...?subject=Subject%20Baru&body=...">
```

### **Mengubah Body:**
```html
<!-- Ganti body text -->
<a href="mailto:...?subject=...&body=Text%20baru%0A%0AParagraf%20baru">
```

### **Mengubah Nomor Telepon:**
```html
<!-- Ganti nomor -->
<a href="tel:+628123456789">
```

---

## ✅ Hasil Akhir

**User sekarang bisa:**
- ✅ Klik "Email" → Langsung buka aplikasi email
- ✅ Klik "Kontak" → Langsung buka aplikasi telepon
- ✅ Klik email di footer → Langsung buka aplikasi email
- ✅ Klik telepon di footer → Langsung buka aplikasi telepon
- ✅ Subject dan body email sudah terisi otomatis
- ✅ Nomor telepon sudah terisi otomatis

**User Experience:**
- 🚀 Lebih cepat menghubungi sekolah
- 📧 Tidak perlu copy-paste email
- 📞 Tidak perlu copy-paste nomor telepon
- ✨ Professional dan modern

---

## 📝 Notes

1. **Email Client Required:**
   - User harus punya aplikasi email terinstall
   - Jika tidak ada, browser akan prompt untuk pilih web mail

2. **Phone App Required:**
   - Di mobile, akan langsung buka phone app
   - Di desktop, butuh app seperti Skype atau Teams

3. **URL Encoding:**
   - Selalu encode special characters
   - Space → %20
   - Newline → %0A

4. **Testing:**
   - Test di berbagai device (desktop, mobile, tablet)
   - Test di berbagai browser (Chrome, Firefox, Safari)
   - Test dengan berbagai email clients

---

**Konfigurasi email dan kontak telah selesai!** 🎉

Refresh halaman dan test klik link Email atau Kontak!
