package main

import (
	"bufio"
	"fmt"
	"log"
	"os"
	"time"
)

var username string
var password string
var falseLogin int = 5

func main() {
	fmt.Println("Lütfen giriş türünüzü seçin:")
	fmt.Println("0 - Admin Girişi")
	fmt.Println("1 - Öğrenci Girişi")

	var userRole int
	fmt.Scanln(&userRole)

	if userRole == 0 {
		adminLogin()
	} else if userRole == 1 {
		studentLogin()
	} else {
		fmt.Println("Geçersiz seçenek seçildi. Lütfen tekrar deneyiniz.")
		main()
	}
}

func adminLogin() {
	adminUsername := "admin"
	adminPassword := "root"

	for falseLogin > 0 {
		fmt.Println("Lütfen admin kullanıcı adını giriniz. ")
		fmt.Scanln(&username)
		fmt.Println("Lütfen admin parolanızı giriniz.")
		fmt.Scanln(&password)

		if username == adminUsername && password == adminPassword {
			logLogin("Admin", "Başarılı")
			fmt.Println("Admin girişi başarılı.")
			adminPanel()
			break
		} else {
			falseLogin--
			fmt.Printf("Kullanıcı adı veya parola yanlış. Kalan deneme hakkınız: %d\n", falseLogin)
			logLogin("Admin", "Başarısız")
		}
	}
}

func studentLogin() {

	studentUsername := "student"
	studentPassword := "12345"

	for falseLogin > 0 {
		fmt.Println("Lütfen öğrenci kullanıcı adınıız giriniz. ")
		fmt.Scanln(&username)
		fmt.Println("Lütfen öğrenci parolanızı giriniz. ")
		fmt.Scanln(&password)

		if username == studentUsername && password == studentPassword {
			logLogin("Öğrenci", "Başarılı")
			fmt.Println("Öğrenci girişi başarılı.")
			break
		} else {
			falseLogin--
			fmt.Printf("Kullanıcı adı veya şifre yanlış. Kalan deneme hakkınız: %d\n", falseLogin)
			logLogin("Öğrenci", "Başarısız")
		}
	}
}

func adminPanel() {

	fmt.Println("Lütfen bir işlem seçin:")
	fmt.Println("0 - Logları Görüntüle")
	fmt.Println("1 - Çıkış Yap")

	var adminSelect int
	fmt.Scanln(&adminSelect)

	if adminSelect == 0 {
		openLogs()
		adminPanel()
	} else if adminSelect == 1 {
		fmt.Println("Çıkış yapılıyor.")
		logout()
	} else {
		fmt.Println("Geçersiz bir işlem seçtiniz. Lütfen tekrar deneyiniz.")
		adminPanel()
	}
}

func openLogs() {
	logsFile, err := os.Open("logs.txt")
	if err != nil {
		log.Fatal(err)
	}
	defer logsFile.Close()

	scanner := bufio.NewScanner(logsFile)
	for scanner.Scan() {
		fmt.Println(scanner.Text())
	}

	if err := scanner.Err(); err != nil {
		log.Fatal(err)
	}
}

func logLogin(userRole, status string) {
	logsFile, err := os.OpenFile("logs.txt", os.O_APPEND|os.O_CREATE|os.O_WRONLY, 0644)
	if err != nil {
		log.Fatal(err)
	}
	defer logsFile.Close()

	currentTime := time.Now().Format("2006-01-02 15:04:05")
	logText := fmt.Sprintf("Kullanıcı Adı: %s\nGiriş Tarihi ve Saati: %s\nGiriş Durumu: %s\n-------------------------------------------\n", userRole, currentTime, status)
	if _, err := logsFile.WriteString(logText); err != nil {
		log.Fatal(err)
	}
}

func logout() {
	os.Exit(0)
}
