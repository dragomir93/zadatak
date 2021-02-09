import React, { Component } from "react";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import Home from './pages/home';
import  OrderHistory  from "./pages/OrderHistory";
import Cart  from "./pages/Cart";
import Checkout  from "./pages/Checkout";
import { NoMatch } from "./pages/NoMatch";
import { Layout } from "./components/Layout";
import  NavigationBar  from "./components/NavigationBar";
import { Jumbotron } from "./components/Jumbotron";

import "./styles.css";

class App extends Component {

  render() {
    return (
      <React.Fragment>
        <Router>
          <NavigationBar/>
          <Jumbotron />
          <Layout>
              <Switch> 
              <Route exact path="/"><Home component={Home} /></Route>
              <Route exact path="/orderHistory" ><OrderHistory component={OrderHistory} /></Route>
              <Route exact path="/cart" ><Cart component={Cart} /></Route>
              <Route exact path="/checkout" ><Checkout component={Checkout} /></Route>
              <Route component={NoMatch} />
            </Switch>
          </Layout>
        </Router>
      </React.Fragment>
    );
  }
}

export default App;
