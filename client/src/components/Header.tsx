import {AppBar, Button, Toolbar, Typography} from "@material-ui/core";
import {Link} from "react-router-dom";

export const HeaderRouter = () => {
    return (
        <AppBar position="static">
            <Toolbar variant="dense">
                <Button component={Link} to="/">
                    <Typography style={{color: "white"}}>News</Typography>
                </Button>
                <Button component={Link} to="/covid">
                    <Typography style={{color: "white"}}>Covid</Typography>
                </Button>
            </Toolbar>
        </AppBar>
    );
};
