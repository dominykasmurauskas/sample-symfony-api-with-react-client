import {Grid} from "@material-ui/core";
import {Line} from "react-chartjs-2";
import {CovidDetailsDto, DayStatisticsDto} from "../api";

interface CovidStatisticsProps {
    covidDetails: CovidDetailsDto | null;
}

const confirmedCases = (dayStatistics: DayStatisticsDto[]) => {
    return {
        labels: dayStatistics.map((x) => x.date),
        datasets: [
            {
                label: "Confirmed",
                data: dayStatistics.map((x) => Number(x.confirmed)),
                fill: false,
                backgroundColor: "rgb(255, 0, 0)",
                borderColor: "rgba(255, 0, 0, 0.2)",
            }
        ],
    };
}

const activeCases = (dayStatistics: DayStatisticsDto[]) => {
    return {
        labels: dayStatistics.map((x) => x.date),
        datasets: [
            {
                label: "Active",
                data: dayStatistics.map((x) => Number(x.active)),
                fill: false,
                backgroundColor: "rgb(15, 16, 86)",
                borderColor: "rgba(15, 16, 86, 0.2)",
            }
        ],
    };
}

const deathCases = (dayStatistics: DayStatisticsDto[]) => {
    return {
        labels: dayStatistics.map((x) => x.date),
        datasets: [
            {
                label: "Deaths",
                data: dayStatistics.map((x) => Number(x.deaths)),
                fill: false,
                backgroundColor: "rgb(41, 26, 2)",
                borderColor: "rgba(41, 26, 2, 0.2)",
            }
        ]
    };
}

export const CovidStatistics: React.FC<CovidStatisticsProps> = (
    {
        covidDetails
    }: CovidStatisticsProps) => {
    const dayStatistics = covidDetails?.data ?? [];

    return (
        <Grid container spacing={3} direction="row" alignItems="flex-start">
            <Grid item xs={12} md={6}>
                <Line data={confirmedCases(dayStatistics)}/>
            </Grid>
            <Grid item xs={12} md={6}>
                <Line data={deathCases(dayStatistics)}/>
            </Grid>
            <Grid item xs={12} md={6}>
                <Line data={activeCases(dayStatistics)}/>
            </Grid>
        </Grid>
    );
};