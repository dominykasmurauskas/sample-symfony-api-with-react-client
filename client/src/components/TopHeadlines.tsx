import {Grid, Typography} from "@material-ui/core";
import {TopHeadlinesDto} from "../api";
import {ArticleCard} from "./ArticleCard";

interface TopHeadlinesProps {
    topHeadlinesDto: TopHeadlinesDto | null;
}

export const TopHeadlines: React.FC<TopHeadlinesProps> = (
    {
        topHeadlinesDto,
    }: TopHeadlinesProps) => {
    return topHeadlinesDto ? (
        <Grid container spacing={2} direction="row" alignItems="flex-start">
            <Grid item xs={12}>
                <Typography variant="h5" style={{paddingBottom: 20}}>Latest news...</Typography>
            </Grid>
            {topHeadlinesDto.articles.map((article) => {
                return (
                    <Grid item xs={12} sm={6} md={3} key={topHeadlinesDto.articles.indexOf(article)}>
                        <ArticleCard articleDto={article}/>
                    </Grid>
                );
            })}
        </Grid>
    ) : (
        <></>
    );
};
