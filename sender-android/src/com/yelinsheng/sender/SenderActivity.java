package com.yelinsheng.sender;

import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;

import android.app.Activity;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.os.Message;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemLongClickListener;
import android.widget.Button;
import android.widget.ListView;
import android.widget.AdapterView.OnItemClickListener;


public class SenderActivity extends Activity {
	private ListView mListView;
	private ArrayList<String> list;
	MyAdapter mAdapter;
	public static ArrayList<String> phone=new ArrayList<String>();;
	public static ArrayList<String> order=new ArrayList<String>();
	public static ArrayList<String> submit=new ArrayList<String>();
	private Button sub=null;
	
	HttpClient httpclient=new DefaultHttpClient();;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sender);
        Bundle bundle = this.getIntent().getExtras();
        
        //获取Bundle中的数据，注意类型和key*/
        String mss = bundle.getString("mss");
        try {
			mss = new String(mss.getBytes("iso-8859-1"),"utf-8");
		} catch (UnsupportedEncodingException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
        
        String [] orderlist=mss.split("and");
        
    	
    	
    	list = new ArrayList<String>();
    	phone.clear();
    	order.clear();
    	submit.clear();
    	sub=(Button) findViewById(R.id.submit);
    	
    	
    	sub.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				new Thread()
        		{
        			public void run()
        			{
        				
        				try{ 
                			//创建连接 
        					
                			HttpClient httpClient = new DefaultHttpClient();
                			
                			HttpPost post = new HttpPost("http://"+LoginActivity.sip+"/sender_submit.php");
                			//设置参数，仿html表单提交 
                			
                			String tmp="";
                			for(int i=0;i<submit.size();i++){
                				tmp=tmp+submit.get(i);
                				tmp=tmp+"and";
                			}
                			
                			List<NameValuePair> paramList = new ArrayList<NameValuePair>(); 
                			BasicNameValuePair param1 = new BasicNameValuePair("submit",tmp); 
                			paramList.add(param1);
                			
                			HttpEntity entity = new UrlEncodedFormEntity(paramList, HTTP.UTF_8);
                			post.setEntity(entity); 
                			//发送HttpPost请求，并返回HttpResponse对象 
                			
                			HttpResponse httpResponse = httpClient.execute(post); 
                			
                			}catch(Exception e){e.printStackTrace();} 
        			}
            		
        		}.start();
        		Intent intent = new Intent();
                intent.setClass(SenderActivity.this, LoginActivity.class);
                startActivity(intent);
			}
		});
    	
    	for(int i=0;i<orderlist.length;i++){
    		orderlist[i]=orderlist[i].replaceAll("\n", "");
			list.add(convert(orderlist[i]));
    	}
		mAdapter = new MyAdapter(this, list);
		mListView = (ListView) findViewById(R.id.list);
		mListView.setAdapter(mAdapter);
		mListView.setFastScrollEnabled(true);
		mListView.setOnItemClickListener(mClickListener);
		mListView.setOnItemLongClickListener(mlongClickListener);
    }
    
    private OnItemClickListener mClickListener = new OnItemClickListener() {
        public void onItemClick(AdapterView<?> av, View v, int arg2, long arg3) {
            // Cancel discovery because it's costly and we're about to connect     
        	
        	Intent intent = new Intent();
			intent.setAction("android.intent.action.CALL");
			intent.setData(Uri.parse("tel:"+ phone.get(arg2)));
			startActivity(intent);
        }
    };
    
    private OnItemLongClickListener mlongClickListener = new OnItemLongClickListener() {
        public boolean onItemLongClick(AdapterView<?> av, View v, int arg2, long arg3) {
            // Cancel discovery because it's costly and we're about to connect     
        	if(submit.contains(order.get(arg2))){
        		submit.remove(order.get(arg2));
        		mAdapter.notifyDataSetChanged();
        	}
        	else{
        		submit.add(order.get(arg2));
        		mAdapter.notifyDataSetChanged();
        	}
			return true;
        }
    };
    
    private String convert(String x){
    	String format="";
    	
    	
    	
    	String [] can=x.split("or");
    	format=format+"订单号: ";
    	format=format+can[0];
    	order.add(can[0]);
    	format=format+"\n电话: ";
    	format=format+can[1];
    	phone.add(can[1]);
    	format=format+"\n地点: ";
    	format=format+can[2];
    	format=format+"\n饭: ";
    	format=format+can[4];
    	format=format+"\n备注: ";
    	format=format+can[3];
		return format;
    	
    }
    
}
