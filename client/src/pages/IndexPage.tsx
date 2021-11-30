import { Box } from "@material-ui/core";
import React, { useEffect, useState } from "react";
import {
  fetchAndBuildTopHeadlines,
  TopHeadlinesDto,
} from "../api";
import {TopHeadlines} from "../components/TopHeadlines";
import publicIp from "public-ip";
import {TextField} from "@mui/material";

export const Index: React.FC = () => {
  const [IP, setIP] = useState<string | null>(null);
  const [topHeadlines, setTopHeadlines] = useState<TopHeadlinesDto | null>(null);

  useEffect(() => {
    async function fetchData() {
      if (!IP) {
        setIP(await publicIp.v4());
      }

      if (IP && !topHeadlines) {
        setTopHeadlines(await fetchAndBuildTopHeadlines(IP));
      }
    }
    fetchData();
  }, [topHeadlines, IP]);

  return (
    <Box className="page-content">
      <Box className="content-block">
        <TextField
            label="Your IP Address"
            value={IP || ''}
            onChange={event => setIP(event.target.value)}
            style={{paddingBottom: 20}}
        />
        <TopHeadlines topHeadlinesDto={topHeadlines}/>
      </Box>
    </Box>
  );
};
