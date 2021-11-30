import {ArticleDto} from "../api";
import {Card, CardActions, CardContent, CardMedia, Button, Typography} from '@mui/material';

interface ArticleCardProps {
    articleDto: ArticleDto | null;
}

export const ArticleCard: React.FC<ArticleCardProps> = (
    {
        articleDto,
    }: ArticleCardProps) => {
    return articleDto ? (
        <Card sx={{maxWidth: 600}}>
            <CardMedia
                component="img"
                height="250"
                image={articleDto.urlToImage}
            />
            <CardContent>
                <Typography gutterBottom variant="h5" component="div">
                    {articleDto.title}
                </Typography>
                <Typography variant="body2" color="text.secondary">
                    {articleDto.description}
                </Typography>
            </CardContent>
            <CardActions>
                <Button size="small" href={articleDto.url} target="_blank">View</Button>
                <Typography variant="body2" marginLeft="auto" color="text.secondary" align="right">
                    {articleDto.author}
                </Typography>
            </CardActions>
        </Card>
    ) : (
        <></>
    );
};
