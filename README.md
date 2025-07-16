# Font Group Management System

A dynamic web application that allows users to:
- Upload `.ttf` font files
- Create font groups using selected fonts
- Preview uploaded fonts
- Delete fonts and font groups
- Perform all actions without refreshing the page (AJAX-enabled)

---

## 🚀 Features

✅ Upload `.ttf` fonts  
✅ Create font groups with two fonts  
✅ Live preview of uploaded fonts  
✅ Dynamically list and delete fonts  
✅ Dynamically manage font groups  
✅ Single-page application interface  
✅ Follows Single Responsibility Principle (SRP)  
✅ Built with Core PHP and jQuery

---

## 🛠️ Technologies Used

- **Frontend**: JavaScript (jQuery), HTML/CSS (No framework used)
- **Backend**: Core PHP
- **AJAX**: For seamless interactivity
- **Session Storage**: Used to manage font groups temporarily

---



## How to Run

1. Copy this folder into your XAMPP `htdocs/` directory.
2. Start Apache from XAMPP Control Panel.
3. Open your browser and go to:  
   `http://localhost/task1_font_group_system/`

## 📂 Folder Structure

task1_font_group_system/
├── index.php
├── upload.php
├── delete_font.php
├── list_fonts.php
├── fontGroups.php
├── delete_group.php
├── delete_group_font.php
├── uploads/ # Stores .ttf files
└── README.md


