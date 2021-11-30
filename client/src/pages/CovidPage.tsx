import { Box, Grid } from "@material-ui/core";
import DayjsUtils from '@date-io/dayjs';
import { MuiPickersUtilsProvider, DatePicker } from '@material-ui/pickers';
import React, { useEffect, useState } from "react";
import {
  fetchAndBuildCovidStatistics,
  CovidDetailsDto,
} from "../api";
import { CovidStatistics } from "../components/CovidStatistics";
import {TextField} from "@mui/material";
import publicIp from "public-ip";

export const Covid: React.FC = () => {
  let today = new Date();
  let weekAgo = new Date(today.getFullYear(), today.getMonth(), today.getDate()-7);

  const [dateFrom, setDateFrom] = useState<string | null>(weekAgo.toISOString().split('T')[0]);
  const [dateTo, setDateTo] = useState<string | null>(today.toISOString().split('T')[0]);
  const [IP, setIP] = useState<string | null>(null);
  const [covidDetails, setCovidDetails] = useState<CovidDetailsDto | null>(null);

  useEffect(() => {
    setCovidDetails(null);

    async function fetchData() {
      if (!IP) {
        setIP(await publicIp.v4());
      }

      if (dateFrom && dateTo && IP) {
        setCovidDetails(await fetchAndBuildCovidStatistics(dateFrom, dateTo, IP));
      }
    }
    fetchData();
  }, [dateFrom, dateTo, IP]);

  return (
    <Box className="page-content">
      <Box className="content-block">
        <TextField
            label="Your IP Address"
            value={IP || ''}
            onChange={event => setIP(event.target.value)}
        />
        <MuiPickersUtilsProvider utils={DayjsUtils}>
          <Grid container spacing={1} direction="row" alignItems="flex-start" style={{marginBottom: 40}}>
            <Grid item>
              <DatePicker
                  disableToolbar
                  variant="inline"
                  label="From"
                  format="YYYY-MM-DD"
                  margin="normal"
                  value={dateFrom}
                  maxDate={dateTo}
                  onChange={newDate => setDateFrom(newDate?.format('YYYY-MM-DD') ?? null)}
                  autoOk={true}
              />
            </Grid>
            <Grid item>
              <DatePicker
                  label="To"
                  disableToolbar
                  variant="inline"
                  margin="normal"
                  format="YYYY-MM-DD"
                  minDate={dateFrom}
                  maxDate={new Date()}
                  value={dateTo}
                  onChange={newDate => setDateTo(newDate?.format('YYYY-MM-DD') ?? null)}
                  autoOk={true}
              />
            </Grid>
          </Grid>
        </MuiPickersUtilsProvider>
        {covidDetails ? (
            <CovidStatistics covidDetails={covidDetails}/>
        ) : (
            <></>
        )}
      </Box>
    </Box>
  );
};
