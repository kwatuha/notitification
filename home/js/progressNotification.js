var  startedWork;
var startedTask;
var activatedProgress;
function showProcessProgress(jobCount){
 Ext.require([
    'Ext.ProgressBar'
]);
Ext.onReady(function(){
   var ld=document.getElementById('notifyme');
	ld.innerHTML='';
    var Runner = function(){
        var f = function(v, pbar, btn, count, cb){
            return function(){
                if(v > count){
                    btn.dom.disabled = false;
                    cb();
                }else{
                    if(pbar.id=='pbar4'){
                        //give this one a different count style for fun
                        var i = v/count;
                        pbar.updateProgress(i, Math.round(100*i)+'% completed...');
                    }else{
                        pbar.updateProgress(v/count, 'Loading item ' + v + ' of '+count+'...');
                    }
                }
           };
        };
        return {
            run : function(pbar, btn, count, cb) {
                if(btn!==undefined){
                btn.dom.disabled = true;
                  startedWork = startJob(f, pbar, btn, jobCount, cb);             
                }
                
            }
        };
    }();

    var pbar2 = Ext.create('Ext.ProgressBar', {
        text:'Ready',
        id:'pbar2',
        cls:'left-align',
        renderTo:'notifyme'
    });
    activatedProgress=pbar2;
    var btn2 = Ext.get('btn2');
      Runner.run(pbar2, btn2, jobCount, function() {
            pbar2.reset();
            pbar2.updateText('Done.');
            
        }); 
  });
  //ld.innerHTML='';
}


function getTotalWork(table){
Ext.Ajax.request({
  loadMask: true,
    url: 'toDoProgress.php',
  params: {t: table},
  success: function(resp) {
  showProcessProgress(resp.responseText);
  }
    });
}

function startJob(f, pbar, btn, count, cb){
    var ts=0;
            var updateClock = function(ts){
                   
                   if(ts<=count){     
                        startedWork=  setTimeout(f(ts, pbar, btn, count, cb), 10);
                   } else{
                       Ext.TaskManager.stop(startedTask);
                       activatedProgress.updateText('Done.');
                   }            
        } 
        startedTask = {
            run: updateClock,
            interval: 1000 //1 second
        }

         Ext.TaskManager.start(startedTask);    
}


