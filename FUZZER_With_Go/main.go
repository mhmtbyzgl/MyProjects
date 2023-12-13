package main

import (
	"bufio"
	"flag"
	"fmt"
	"log"
	"net/http"
	"os"
)

func worker(w int, jobs <-chan string, results chan<- string, status int) {
	for j := range jobs {
		resp, err := http.Get(j)
		if err != nil {
			log.Fatal(err)
		}
		defer resp.Body.Close()

		if status > 0 {
			if status == resp.StatusCode {
				results <- fmt.Sprintf("%s Status Code: %d", j, resp.StatusCode)
			}
		} else if status == 0 {
			if resp.StatusCode != 404 {
				results <- fmt.Sprintf("%s Status Code: %d", j, resp.StatusCode)
			}
		}
	}
}

func main() {
	var i int = 1
	jobs := make(chan string, 100)
	results := make(chan string, 100)

	url := flag.String("u", "", "Link Girin... \n")
	wordList := flag.String("w", "./wordlist.txt", "Dosya yolunu giriniz.\n")
	status := flag.Int("s", 0, "Listelenmesini istedğiniz cevap durum kodunu giriniz.\n ")
	flag.Parse()

	if *url == "" || *wordList == "" {
		fmt.Println("'-u' parametresini kullanarak link ekleyiniz ve '-w' parametresini kullanarak kullanılacak olan dosyayı belirtiniz.")
	} else {
		go func() {
			file, err := os.Open(*wordList)
			if err != nil {
				log.Fatal(err)
			}
			Scanner := bufio.NewScanner(file)

			for Scanner.Scan() {
				jobs <- *url + Scanner.Text()
			}
			close(jobs)

		}()

		for w := 1; w <= 100; w++ {
			go worker(w, jobs, results, *status)
		}

		for f := range results {
			fmt.Printf("%d - %s\n", i, f)
			i++
		}
	}
}
