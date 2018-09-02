import React, { Component } from 'react';
import { connect } from "react-redux";
import {bindActionCreators} from 'redux';
// import * as actions from '../../actions'

import * as authActions from '../../actions/auth'

import AuthFacebookLogin from '../../components/auth/AuthFacebookLogin'

class Home extends Component {

  componentWillMount() {
    console.log('*****')
    console.log( this.props )



    // this.props.signUpRequest();
  }

  fetchInstagram = ( dd ) => {
    console.log('accessToken')
    console.log(dd)

    let base = "https://graph.facebook.com/v3.1/";

    // curl -i -X GET \
 let aa = "https://graph.facebook.com/v3.1/me?fields=id%2Cname&access_token=EAAfAH1u088MBADa77Qj1pmuqMrb1dDsHSGKv5j5bbZBE7a2u4EjKvLdlwwEt40weZBefPm36SmbZB5LbjEVi0hbMCITszfpul4lW723rEGHdNwzl9ZABDTdXVcZB16Qi9nEYuMVzLyQLwARCFyfImfZAzNXjOrZAUgFrASxhF7bEdSCi7AHqTD6K3gZAOzpZA0UfT9ZBLvbQIE3QZDZD"

    // let url ="https://graph.facebook.com/1509223105963354/?fields=instagram_business_account,instagram_accounts{follow_count,followed_by_count,media_count,username}";
    let url = base +'me/accounts?'

    url += '&access_token='+ dd.accessToken

    console.log( url )

    fetch(url,{
      method:"GET"
    }) // Call the fetch function passing the url of the API as a parameter
    .then(function(daa) {
      console.log('---1')
      console.log(daa)
      return daa.json()
        // Your code for handling the data you get from the API
    })
    .then(function(dd){
      console.log('----DDqqqq')
      console.log(dd)



      let bus = {};
      dd.data.map((i) => {
        if( i.id == '137605103254949'){
          bus = i;
        }
      })

      console.log( bus )

      let nnn = base + bus.id + '?fields=instagram_business_account,instagram_accounts{media_count,username,follow_count,followed_by_count}'
      nnn += '&access_token='+ bus.access_token

      console.log(nnn)

console.log(nnn)
      fetch(nnn,{
        method:'GET'
      }).then(function(a){
        return a.json()
      }).then(function(b){
        console.log('b')
        console.log(b)
      })






    })
    // .then(function(dd){
    //   console.log('----DD')
    //   console.log(dd)
    // })
    .catch(function(daaa) {
      console.log('---2')
      console.log(daaa)
        // This is where yu run code if the server returns any errors
    });
  }


  success = (data) => {
    console.log('success')
    console.log( data )
    this.fetchInstagram( data)
  }

  error = (data) => {
    console.log('error')
    console.log( data )
  }

  _onSuccessLogin = (userInfo) => {
    console.log('--userInfo')
    console.log( userInfo)
    this.fetchInstagram( userInfo)
    this.props.signUpRequest(userInfo);
  }

  render() {
    console.log( this.props )
    return (
      <div>
        <h1>Home Page</h1>
        <AuthFacebookLogin
          onSuccessLogin={this._onSuccessLogin}
        />
      </div>
    )
  }
}

const mapStateToProps = ( state ) => {
  return {
    state
  }
}

const mapDispatchToProps = ( dispatch ) => {
  return bindActionCreators(authActions, dispatch);
}

export default connect( mapStateToProps, mapDispatchToProps )(Home)