package main

import (
	"flag"
	"fmt"
	"log"
	"strings"

	"github.com/gocolly/colly"
)

func main() {

	siteSelection := flag.String("site", "", "Haber sitesi seçmenizi sağlar. \n Örnek Kullanım: -site '1 or 2' \n\n 1 - The Hacker News \n 2 - Sporx Son Dakika Haberleri")
	dateFilter := flag.Bool("date", false, "Tarih bilgilerini göster.\n Örnek Kullanım: -site '1 or 2' -date\n")
	descriptionFilter := flag.Bool("desc", false, "Açıklama bilgilerini göster.\n Örnek Kullanım: -site '1 or 2' -desc\n")
	flag.Parse()

	if *siteSelection == "" {
		log.Fatal("Eksik parametre girdiniz. Açıklamalar ve örnek kullanım için lütfen '-h' parametresi giriş yapınız.")
	}
	sites := strings.Split(*siteSelection, ",")
	for _, site := range sites {
		switch site {
		case "1":
			getNews1("https://thehackernews.com/", *dateFilter, *descriptionFilter)
		case "2":
			getNews2("https://www.sporx.com/son-dakika-spor-haberleri/", *dateFilter, *descriptionFilter)
		default:
			log.Fatalf("Geçersiz haber sitesi: %s. Desteklenen değerler: '1 veya 2'", site)
		}
	}

}

func getNews1(scrapeURL string, dateFilter bool, descriptionFilter bool) {

	c := colly.NewCollector(colly.AllowedDomains("thehackernews.com"))

	c.OnError(func(r *colly.Response, err error) {
		fmt.Printf("Error: %s\n", err.Error())
	})

	c.OnHTML("div.body-post", func(h *colly.HTMLElement) {
		selection := h.DOM

		title := selection.Find("h2.home-title").Text()
		date := selection.Find("span.h-datetime").Text()
		trimmedDate := date[3:]
		description := selection.Find("div.home-desc").Text()
		newsLink := selection.Find("a.story-link").AttrOr("href", "")
		if !dateFilter && !descriptionFilter {
			fmt.Printf("Haber Başlığı: %s\n\n Tarih: %s\n\n Açıklama: %s...\n\n Haberin devamını okumak için linke tıklayınız. %s\n\n ----------------------------------------------------------------------------------\n\n", title, trimmedDate, description, newsLink)

		} else if dateFilter && !descriptionFilter {

			fmt.Printf("Haber Başlığı: %s\n\n Açıklama: %s...\n\n Haberin devamını okumak için linke tıklayınız. %s\n\n ----------------------------------------------------------------------------------\n\n", title, description, newsLink)

		} else if !dateFilter && descriptionFilter {
			fmt.Printf("Haber Başlığı: %s\n\n Tarih: %s\n\n ----------------------------------------------------------------------------------\n\n", title, trimmedDate)

		} else {
			fmt.Printf("Haber Başlığı: %s\n\n ----------------------------------------------------------------------------------\n\n", title)

		}

	})

	c.Visit(scrapeURL)
}

func getNews2(scrapeURL string, dateFilter bool, descriptionFilter bool) {
	c := colly.NewCollector(colly.AllowedDomains("www.sporx.com", "sporx.com"))

	c.OnError(func(r *colly.Response, err error) {
		fmt.Printf("Error: %s\n", err.Error())
	})

	c.OnHTML("div.row-sondakika", func(h *colly.HTMLElement) {
		selection := h.DOM

		title := selection.Find("h4.sd-title").Text()

		time := selection.Find("div.sd-date span").Text()
		trimmedTime := time[:5]

		date := selection.Find("div.sd-date span").Text()
		trimmedDate := date[len(date)-10:]

		description := selection.Find("p.sd-desc a").Text()

		newsLink := selection.Find("h4.sd-title a").AttrOr("href", "")
		httpsLink := "https:" + newsLink

		if !dateFilter && !descriptionFilter {
			fmt.Printf("Haber Başlığı: %s\n\n Tarih: %s Saat: %s\n\n Açıklama: %s...\n\n Haberin devamını okumak için linke tıklayınız. %s\n\n ----------------------------------------------------------------------------------\n\n", title, trimmedDate, trimmedTime, description, httpsLink)

		} else if dateFilter && !descriptionFilter {

			fmt.Printf("Haber Başlığı: %s\n\n Açıklama: %s...\n\n Haberin devamını okumak için linke tıklayınız. %s\n\n ----------------------------------------------------------------------------------\n\n", title, description, httpsLink)

		} else if !dateFilter && descriptionFilter {
			fmt.Printf("Haber Başlığı: %s\n\n Tarih: %s Saat: %s\n\n ----------------------------------------------------------------------------------\n\n", title, trimmedDate, trimmedTime)

		} else {
			fmt.Printf("Haber Başlığı: %s\n\n ----------------------------------------------------------------------------------\n\n", title)

		}

	})

	c.Visit(scrapeURL)
}
