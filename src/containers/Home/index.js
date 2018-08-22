import React, { Component } from 'react';
import { connect } from "react-redux";
import {bindActionCreators} from 'redux';
import * as actions from '../../actions'

class Home extends Component {

  componentWillMount() {
    console.log( this.props )
    this.props.getHomePageData();
  }

  render() {
    console.log( this.props )
    return (
      <h1>Home Page</h1>
    )
  }
}

const mapStateToProps = ( state ) => {
  return {
    state
  }
}

const mapDispatchToProps = ( dispatch ) => {
  return bindActionCreators(actions, dispatch);
}

export default connect( mapStateToProps, mapDispatchToProps )(Home)