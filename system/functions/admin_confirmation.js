var AdminModal = document.getElementById("adminModal");
var PassInput = document.getElementById("adminPass");
var ActionType;
var ArgsArray;

function RequestAdminAction(type, args)
{
	ActionType = type;
	ArgsArray = args;
	
	if(UserType < 2)
	{
		OpenAdminModal();
	}
	else
	{
		ExecuteAction();
	}
}

function OpenAdminModal()
{
	AdminModal.style.display = "block";
}

function AdminCancel()
{
	AdminModal.style.display = "none";
	passInput.value = "";
	ActionType = 0;
	ArgsArray = new Array();
}

function AdminConfirm()
{
	if(PassInput.value == MasterPass)
	{
		ExecuteAction();
	}
	else
	{
		alert("Incorrect Password!");
		AdminCancel();
	}
}

function ExecuteAction()
{
	switch(ActionType)
	{
		case 1:
			// open url
			window.location.href = ArgsArray[0];
			break;
		case 2:
			// Execute function
			var params = "";
			window[ArgsArray[0]](params);
		default:
			AdminCancel();
	}
	
	AdminCancel();
}