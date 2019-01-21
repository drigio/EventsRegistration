package com.example.drigio.eventregistrations;

import android.app.DownloadManager;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    //Declare Variables
    ProgressBar progressBar;
    Button login;
    EditText username,password;
    final String server = "http://gpptech.000webhostapp.com/EventRegistration/Backend/login.php";
    String message,userid,userType,name,eventid,Username,Password;
    SharedPreferences sharedPreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        progressBar = findViewById(R.id.loginProgressBar);
        progressBar.setVisibility(View.INVISIBLE);
        login = findViewById(R.id.login);
        username = findViewById(R.id.username);
        password = findViewById(R.id.password);
        sharedPreferences = getSharedPreferences("myprefs",Context.MODE_PRIVATE);

        //Check if user Details are present
        if(sharedPreferences.contains("username")) {
            useLoginDetails();
            sendDetails();
            Log.d("my","Present Details");
        }


        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Log.d("my","No Details were found");
                getDetails();
                saveDetails();
                sendDetails();
            }
        });
    }

    private void getDetails() {
        Username = username.getText().toString();
        Password = password.getText().toString();
    }

    private void useLoginDetails() {
        sharedPreferences = getSharedPreferences("myprefs",Context.MODE_PRIVATE);
        Username = sharedPreferences.getString("username","");
        Password = sharedPreferences.getString("password","");
        Log.d("my","Got details " + Username + " " + Password);
        Toast.makeText(LoginActivity.this,"Please wait Logging in",Toast.LENGTH_SHORT).show();
    }

    private void sendDetails(){

        Log.d("amy",username.getText().toString());
        StringRequest request = new StringRequest(Request.Method.POST,server, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                progressBar.setVisibility(View.INVISIBLE);
              parseDetails(response);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                progressBar.setVisibility(View.INVISIBLE);
                Toast.makeText(LoginActivity.this,"Couldn't Auto Login. Please check if you have a working Internet Connection",Toast.LENGTH_LONG).show();
                error.printStackTrace();
            }
        }){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<String,String>();
                params.put("username",Username);
                params.put("password",Password);
                return params;
            }
        };

        SingletonClass.getmInstance(LoginActivity.this).addToRequestQueue(request);
        progressBar.setVisibility(View.VISIBLE);

    }

    private void parseDetails(String response) {
        try {
            //Parse JSON and grab details
            JSONObject jsonObject = new JSONObject(response);
            message = jsonObject.getString("loginMessage");
            name = jsonObject.getString("user");
            userid = jsonObject.getString("userid");
            userType = jsonObject.getString("usertype");
            eventid = jsonObject.getString("eventid");

            Toast.makeText(LoginActivity.this,message,Toast.LENGTH_LONG);

            Intent intent = new Intent(LoginActivity.this,MainActivity.class);
            intent.putExtra("name",name);
            intent.putExtra("userid",userid);
            intent.putExtra("userType",userType);
            intent.putExtra("eventid",eventid);
            finish();
            startActivity(intent);

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    private void saveDetails() {
        sharedPreferences = getSharedPreferences("myprefs", Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString("username",Username);
        editor.putString("password",Password);
        editor.apply();
    }

}
