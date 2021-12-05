export class ArticleDto {
  constructor(
      public author: string,
      public title: string,
      public description: string,
      public url: string,
      public urlToImage:string,
      public publishedAt: string
  ) {}
}

export class TopHeadlinesDto {
  constructor(public articles: ArticleDto[]) {}
}

export const fetchAndBuildTopHeadlines = async (IP: string) => {
  const articles: ArticleDto[] = [];

  await fetch("https://127.0.0.1:8000/news", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      "X-User-Ip": IP,
    }
  })
    .then((data) => data.json())
    .then((jsonData) => {
      for (const jsonDataElement of jsonData.articles) {
        const { author, title, description, url, urlToImage, publishedAt } = jsonDataElement;
        const article = new ArticleDto(author, title, description, url, urlToImage, publishedAt);
        articles.push(article);
      }
    })
    .catch((e) => console.log(e));

  return new TopHeadlinesDto(articles);
};

export class DayStatisticsDto {
  constructor(public confirmed: string, public deaths: string, public date: string ) {}
}

export class CovidDetailsDto {
  constructor(public data: DayStatisticsDto[], public from: Date, public to: Date) {}
}

export const fetchAndBuildCovidStatistics = async (
    dateFrom: string | null,
    dateTo: string | null,
    IP: string
) => {
  const daysStatistics: DayStatisticsDto[] = [];
  let from = new Date();
  let to = new Date();

  await fetch("https://127.0.0.1:8000/covid?" + new URLSearchParams({
    from: dateFrom ?? '',
    to: dateTo ?? ''
  }), {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      "X-User-Ip": IP,
    }
  })
      .then((data) => data.json())
      .then((jsonData) => {
        from = jsonData.from;
        to = jsonData.to;

        for (const jsonDataElement of jsonData.data) {
          const { confirmed, deaths, date } = jsonDataElement;
          const dayStatistics = new DayStatisticsDto(confirmed, deaths, date);
          daysStatistics.push(dayStatistics);
        }
      })
      .catch((e) => console.log(e));

  return new CovidDetailsDto(daysStatistics, from, to);
};

