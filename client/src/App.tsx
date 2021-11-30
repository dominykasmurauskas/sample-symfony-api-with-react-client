import React from "react";
import {BrowserRouter as Router, Switch, Route} from "react-router-dom";
import {HeaderRouter} from "./components/Header";
import {Index as IndexPage} from "./pages/IndexPage";
import {Covid as CovidPage} from "./pages/CovidPage";

function App() {
    return (
        <Router>
            <HeaderRouter/>

            <Switch>
                <Route path="/covid">
                    <CovidPage/>
                </Route>
                <Route path="/">
                    <IndexPage/>
                </Route>
            </Switch>
        </Router>
    );
}

export default App;
