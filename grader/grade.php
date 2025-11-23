<?php require_once "includes/header.php"; require_login(); ?>

<?php $project_id = $_GET['id']; ?>

<h3>Grading</h3>

<div id="rubric"></div>
<button class="btn btn-success mt-3" onclick="saveGrade()">Save Grade</button>
<div id="msg" class="mt-2"></div>

<script>
let rubricData = null;
let pid = <?= $project_id ?>;

async function loadData(){
  const r = await fetch("api/get_project_for_grading.php?id=" + pid);
  const data = await r.json();
  rubricData = data;
  
  const box = document.getElementById("rubric");
  box.innerHTML = `<h4>${data.project.title}</h4>`;

  data.criteria.forEach(c=>{
    box.innerHTML += `
      <div class="card p-3 mt-3">
        <h5>${c.title} <small class="text-muted">/ ${c.max_score}</small></h5>
        <input type="number" class="form-control mt-2 score" 
               data-id="${c.id}" placeholder="Enter Score">
      </div>`;
  });
}
loadData();

async function saveGrade(){
  const items = [...document.querySelectorAll(".score")].map(el => ({
    criteria_id: el.dataset.id,
    score: parseFloat(el.value || 0)
  }));

  const r = await fetch("api/save_grade.php", {
    method:"POST",
    headers:{ "Content-Type":"application/json" },
    body: JSON.stringify({ project_id: pid, rubric_id: rubricData.rubric_id, items })
  });

  const out = await r.json();
  document.getElementById("msg").innerHTML =
    out.success ? "Saved!" : out.error;
}
</script>

<?php require_once "includes/footer.php"; ?>
