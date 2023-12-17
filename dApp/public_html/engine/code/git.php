<?php
/**
* Git repository.
* @path /engine/code/git.php
*
* @name    DAO Mansion    @version 1.0.2
* @author  Aleksandr Vorkunov  <developing@nodes-tech.ru>
* @license http://www.apache.org/licenses/LICENSE-2.0
*/
/*
$content = engine::curl_get_query("https://github.com/restinpc/DAO");
$content = preg_replace('#href="/#', 'target="_blank" href="https://github.com/', $content);
$content = preg_replace('#<div class="Box-header position-relative">.*?<h2 class="sr-only">Latest commit</h2>.*?</ul>.*?</div>.*?</div>.*?</div>#s', '', $content);
$content = preg_replace('#<div class="Box mb-3">.*?</div>#s', '', $content);
$content = preg_replace('#<div data-view-component="true" class="include-fragment-error.*?</div>#s', '', $content);
echo preg_replace('#<header.*?</header>#s', '', $content);
*/
?>


<!DOCTYPE html>
<html lang="en" data-color-mode="auto" data-light-theme="light" data-dark-theme="dark"  data-a11y-animated-images="system">
<head>
    <meta charset="utf-8">
    <link rel="dns-prefetch" href="https://github.githubassets.com">
    <link rel="dns-prefetch" href="https://avatars.githubusercontent.com">
    <link rel="dns-prefetch" href="https://github-cloud.s3.amazonaws.com">
    <link rel="dns-prefetch" href="https://user-images.githubusercontent.com/">
    <link rel="preconnect" href="https://github.githubassets.com" crossorigin>
    <link rel="preconnect" href="https://avatars.githubusercontent.com">



    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/light-4569ff6a5326.css" /><link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/dark-34efc528590d.css" /><link data-color-theme="dark_dimmed" crossorigin="anonymous" media="all" rel="stylesheet" data-href="https://github.githubassets.com/assets/dark_dimmed-b94a34c1d526.css" /><link data-color-theme="dark_high_contrast" crossorigin="anonymous" media="all" rel="stylesheet" data-href="https://github.githubassets.com/assets/dark_high_contrast-a826e4e21b45.css" /><link data-color-theme="dark_colorblind" crossorigin="anonymous" media="all" rel="stylesheet" data-href="https://github.githubassets.com/assets/dark_colorblind-6e131b11dd64.css" /><link data-color-theme="light_colorblind" crossorigin="anonymous" media="all" rel="stylesheet" data-href="https://github.githubassets.com/assets/light_colorblind-6861c53bb0f6.css" /><link data-color-theme="light_high_contrast" crossorigin="anonymous" media="all" rel="stylesheet" data-href="https://github.githubassets.com/assets/light_high_contrast-1cfc1f582a4c.css" /><link data-color-theme="light_tritanopia" crossorigin="anonymous" media="all" rel="stylesheet" data-href="https://github.githubassets.com/assets/light_tritanopia-2fb3a50ca380.css" /><link data-color-theme="dark_tritanopia" crossorigin="anonymous" media="all" rel="stylesheet" data-href="https://github.githubassets.com/assets/dark_tritanopia-3da111582952.css" />

    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/primer-primitives-fb1d51d1ef66.css" />
    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/primer-53690bf8aadd.css" />
    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/global-d31d56021874.css" />
    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/github-2c7b1701fb19.css" />
    <link crossorigin="anonymous" media="all" rel="stylesheet" href="https://github.githubassets.com/assets/code-5aae01d45c34.css" />


    <meta name="optimizely-datafile" content="{&quot;groups&quot;: [], &quot;environmentKey&quot;: &quot;production&quot;, &quot;rollouts&quot;: [], &quot;typedAudiences&quot;: [], &quot;projectId&quot;: &quot;16737760170&quot;, &quot;variables&quot;: [], &quot;featureFlags&quot;: [], &quot;experiments&quot;: [], &quot;version&quot;: &quot;4&quot;, &quot;audiences&quot;: [{&quot;conditions&quot;: &quot;[\&quot;or\&quot;, {\&quot;match\&quot;: \&quot;exact\&quot;, \&quot;name\&quot;: \&quot;$opt_dummy_attribute\&quot;, \&quot;type\&quot;: \&quot;custom_attribute\&quot;, \&quot;value\&quot;: \&quot;$opt_dummy_value\&quot;}]&quot;, &quot;id&quot;: &quot;$opt_dummy_audience&quot;, &quot;name&quot;: &quot;Optimizely-Generated Audience for Backwards Compatibility&quot;}], &quot;anonymizeIP&quot;: true, &quot;sdkKey&quot;: &quot;WTc6awnGuYDdG98CYRban&quot;, &quot;attributes&quot;: [{&quot;id&quot;: &quot;16822470375&quot;, &quot;key&quot;: &quot;user_id&quot;}, {&quot;id&quot;: &quot;17143601254&quot;, &quot;key&quot;: &quot;spammy&quot;}, {&quot;id&quot;: &quot;18175660309&quot;, &quot;key&quot;: &quot;organization_plan&quot;}, {&quot;id&quot;: &quot;18813001570&quot;, &quot;key&quot;: &quot;is_logged_in&quot;}, {&quot;id&quot;: &quot;19073851829&quot;, &quot;key&quot;: &quot;geo&quot;}, {&quot;id&quot;: &quot;20175462351&quot;, &quot;key&quot;: &quot;requestedCurrency&quot;}, {&quot;id&quot;: &quot;20785470195&quot;, &quot;key&quot;: &quot;country_code&quot;}, {&quot;id&quot;: &quot;21656311196&quot;, &quot;key&quot;: &quot;opened_downgrade_dialog&quot;}], &quot;botFiltering&quot;: false, &quot;accountId&quot;: &quot;16737760170&quot;, &quot;events&quot;: [{&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;17911811441&quot;, &quot;key&quot;: &quot;hydro_click.dashboard.teacher_toolbox_cta&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18124116703&quot;, &quot;key&quot;: &quot;submit.organizations.complete_sign_up&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18145892387&quot;, &quot;key&quot;: &quot;no_metric.tracked_outside_of_optimizely&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18178755568&quot;, &quot;key&quot;: &quot;click.org_onboarding_checklist.add_repo&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18180553241&quot;, &quot;key&quot;: &quot;submit.repository_imports.create&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18186103728&quot;, &quot;key&quot;: &quot;click.help.learn_more_about_repository_creation&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18188530140&quot;, &quot;key&quot;: &quot;test_event&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18191963644&quot;, &quot;key&quot;: &quot;click.empty_org_repo_cta.transfer_repository&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18195612788&quot;, &quot;key&quot;: &quot;click.empty_org_repo_cta.import_repository&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18210945499&quot;, &quot;key&quot;: &quot;click.org_onboarding_checklist.invite_members&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18211063248&quot;, &quot;key&quot;: &quot;click.empty_org_repo_cta.create_repository&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18215721889&quot;, &quot;key&quot;: &quot;click.org_onboarding_checklist.update_profile&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18224360785&quot;, &quot;key&quot;: &quot;click.org_onboarding_checklist.dismiss&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18234832286&quot;, &quot;key&quot;: &quot;submit.organization_activation.complete&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18252392383&quot;, &quot;key&quot;: &quot;submit.org_repository.create&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18257551537&quot;, &quot;key&quot;: &quot;submit.org_member_invitation.create&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18259522260&quot;, &quot;key&quot;: &quot;submit.organization_profile.update&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18564603625&quot;, &quot;key&quot;: &quot;view.classroom_select_organization&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18568612016&quot;, &quot;key&quot;: &quot;click.classroom_sign_in_click&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18572592540&quot;, &quot;key&quot;: &quot;view.classroom_name&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18574203855&quot;, &quot;key&quot;: &quot;click.classroom_create_organization&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18582053415&quot;, &quot;key&quot;: &quot;click.classroom_select_organization&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18589463420&quot;, &quot;key&quot;: &quot;click.classroom_create_classroom&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18591323364&quot;, &quot;key&quot;: &quot;click.classroom_create_first_classroom&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18591652321&quot;, &quot;key&quot;: &quot;click.classroom_grant_access&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18607131425&quot;, &quot;key&quot;: &quot;view.classroom_creation&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18831680583&quot;, &quot;key&quot;: &quot;upgrade_account_plan&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19064064515&quot;, &quot;key&quot;: &quot;click.signup&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19075373687&quot;, &quot;key&quot;: &quot;click.view_account_billing_page&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19077355841&quot;, &quot;key&quot;: &quot;click.dismiss_signup_prompt&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19079713938&quot;, &quot;key&quot;: &quot;click.contact_sales&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19120963070&quot;, &quot;key&quot;: &quot;click.compare_account_plans&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19151690317&quot;, &quot;key&quot;: &quot;click.upgrade_account_cta&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19424193129&quot;, &quot;key&quot;: &quot;click.open_account_switcher&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19520330825&quot;, &quot;key&quot;: &quot;click.visit_account_profile&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19540970635&quot;, &quot;key&quot;: &quot;click.switch_account_context&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19730198868&quot;, &quot;key&quot;: &quot;submit.homepage_signup&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19820830627&quot;, &quot;key&quot;: &quot;click.homepage_signup&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19988571001&quot;, &quot;key&quot;: &quot;click.create_enterprise_trial&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20036538294&quot;, &quot;key&quot;: &quot;click.create_organization_team&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20040653299&quot;, &quot;key&quot;: &quot;click.input_enterprise_trial_form&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20062030003&quot;, &quot;key&quot;: &quot;click.continue_with_team&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20068947153&quot;, &quot;key&quot;: &quot;click.create_organization_free&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20086636658&quot;, &quot;key&quot;: &quot;click.signup_continue.username&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20091648988&quot;, &quot;key&quot;: &quot;click.signup_continue.create_account&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20103637615&quot;, &quot;key&quot;: &quot;click.signup_continue.email&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20111574253&quot;, &quot;key&quot;: &quot;click.signup_continue.password&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20120044111&quot;, &quot;key&quot;: &quot;view.pricing_page&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20152062109&quot;, &quot;key&quot;: &quot;submit.create_account&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20165800992&quot;, &quot;key&quot;: &quot;submit.upgrade_payment_form&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20171520319&quot;, &quot;key&quot;: &quot;submit.create_organization&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20222645674&quot;, &quot;key&quot;: &quot;click.recommended_plan_in_signup.discuss_your_needs&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20227443657&quot;, &quot;key&quot;: &quot;submit.verify_primary_user_email&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20234607160&quot;, &quot;key&quot;: &quot;click.recommended_plan_in_signup.try_enterprise&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20238175784&quot;, &quot;key&quot;: &quot;click.recommended_plan_in_signup.team&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20239847212&quot;, &quot;key&quot;: &quot;click.recommended_plan_in_signup.continue_free&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20251097193&quot;, &quot;key&quot;: &quot;recommended_plan&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20438619534&quot;, &quot;key&quot;: &quot;click.pricing_calculator.1_member&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20456699683&quot;, &quot;key&quot;: &quot;click.pricing_calculator.15_members&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20467868331&quot;, &quot;key&quot;: &quot;click.pricing_calculator.10_members&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20476267432&quot;, &quot;key&quot;: &quot;click.trial_days_remaining&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20476357660&quot;, &quot;key&quot;: &quot;click.discover_feature&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20479287901&quot;, &quot;key&quot;: &quot;click.pricing_calculator.custom_members&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20481107083&quot;, &quot;key&quot;: &quot;click.recommended_plan_in_signup.apply_teacher_benefits&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20483089392&quot;, &quot;key&quot;: &quot;click.pricing_calculator.5_members&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20484283944&quot;, &quot;key&quot;: &quot;click.onboarding_task&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20484996281&quot;, &quot;key&quot;: &quot;click.recommended_plan_in_signup.apply_student_benefits&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20486713726&quot;, &quot;key&quot;: &quot;click.onboarding_task_breadcrumb&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20490791319&quot;, &quot;key&quot;: &quot;click.upgrade_to_enterprise&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20491786766&quot;, &quot;key&quot;: &quot;click.talk_to_us&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20494144087&quot;, &quot;key&quot;: &quot;click.dismiss_enterprise_trial&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20499722759&quot;, &quot;key&quot;: &quot;completed_all_tasks&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20500710104&quot;, &quot;key&quot;: &quot;completed_onboarding_tasks&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20513160672&quot;, &quot;key&quot;: &quot;click.read_doc&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20516196762&quot;, &quot;key&quot;: &quot;actions_enabled&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20518980986&quot;, &quot;key&quot;: &quot;click.dismiss_trial_banner&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20535446721&quot;, &quot;key&quot;: &quot;click.issue_actions_prompt.dismiss_prompt&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20557002247&quot;, &quot;key&quot;: &quot;click.issue_actions_prompt.setup_workflow&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20595070227&quot;, &quot;key&quot;: &quot;click.pull_request_setup_workflow&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20626600314&quot;, &quot;key&quot;: &quot;click.seats_input&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20642310305&quot;, &quot;key&quot;: &quot;click.decrease_seats_number&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20662990045&quot;, &quot;key&quot;: &quot;click.increase_seats_number&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20679620969&quot;, &quot;key&quot;: &quot;click.public_product_roadmap&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20761240940&quot;, &quot;key&quot;: &quot;click.dismiss_survey_banner&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20767210721&quot;, &quot;key&quot;: &quot;click.take_survey&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20795281201&quot;, &quot;key&quot;: &quot;click.archive_list&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20966790249&quot;, &quot;key&quot;: &quot;contact_sales.submit&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20996500333&quot;, &quot;key&quot;: &quot;contact_sales.existing_customer&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20996890162&quot;, &quot;key&quot;: &quot;contact_sales.blank_message_field&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21000470317&quot;, &quot;key&quot;: &quot;contact_sales.personal_email&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21002790172&quot;, &quot;key&quot;: &quot;contact_sales.blank_phone_field&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21354412592&quot;, &quot;key&quot;: &quot;click.dismiss_create_readme&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21366102546&quot;, &quot;key&quot;: &quot;click.dismiss_zero_user_content&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21370252505&quot;, &quot;key&quot;: &quot;account_did_downgrade&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21370840408&quot;, &quot;key&quot;: &quot;click.cta_create_readme&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21375451068&quot;, &quot;key&quot;: &quot;click.cta_create_new_repository&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21385390948&quot;, &quot;key&quot;: &quot;click.zero_user_content&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21467712175&quot;, &quot;key&quot;: &quot;click.downgrade_keep&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21484112202&quot;, &quot;key&quot;: &quot;click.downgrade&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21495292213&quot;, &quot;key&quot;: &quot;click.downgrade_survey_exit&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21508241468&quot;, &quot;key&quot;: &quot;click.downgrade_survey_submit&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21512030356&quot;, &quot;key&quot;: &quot;click.downgrade_support&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21539090022&quot;, &quot;key&quot;: &quot;click.downgrade_exit&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21543640644&quot;, &quot;key&quot;: &quot;click_fetch_upstream&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21646510300&quot;, &quot;key&quot;: &quot;click.move_your_work&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21656151116&quot;, &quot;key&quot;: &quot;click.add_branch_protection_rule&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21663860599&quot;, &quot;key&quot;: &quot;click.downgrade_dialog_open&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21687860483&quot;, &quot;key&quot;: &quot;click.learn_about_protected_branches&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21689050333&quot;, &quot;key&quot;: &quot;click.dismiss_protect_this_branch&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;21864370109&quot;, &quot;key&quot;: &quot;click.sign_in&quot;}], &quot;revision&quot;: &quot;1372&quot;}" />


    <script type="application/json" id="client-env">{"locale":"en","featureFlags":["turbo_experiment_risky","image_metric_tracking","geojson_azure_maps"]}</script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/wp-runtime-063c3e10f2e0.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_stacktrace-parser_dist_stack-trace-parser_esm_js-node_modules_github_bro-a4c183-ae93d3fba59c.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/ui_packages_soft-nav_soft-nav_ts-5bbac172fb2f.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/environment-27e06165e415.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_dompurify_dist_purify_js-64d590970fa6.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_selector-observer_dist_index_esm_js-2646a2c533e3.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_relative-time-element_dist_index_js-99e288659d4f.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_fzy_js_index_js-node_modules_github_markdown-toolbar-element_dist_index_js-e3de700a4c9d.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_delegated-events_dist_index_js-node_modules_github_auto-complete-element-5b3870-9b38c0812424.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_file-attachment-element_dist_index_js-node_modules_github_text-ex-3415a8-7ecc10fb88d0.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_filter-input-element_dist_index_js-node_modules_github_remote-inp-8873b7-5771678648e0.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_primer_view-components_app_components_primer_primer_js-node_modules_gith-e7a1e2-49659aed34cc.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/github-elements-d042ca720710.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/element-registry-0ab836256a11.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_lit-html_lit-html_js-9d9fe1859ce5.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_hydro-analytics-client_dist_analytics-client_js-node_modules_gith-f3aee1-fd3c22610e40.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_morphdom_dist_morphdom-esm_js-b1fdd7158cf0.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_mini-throttle_dist_index_js-node_modules_github_alive-client_dist-bf5aa2-424aa982deef.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_turbo_dist_turbo_es2017-esm_js-ba0e4d5b3207.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_remote-form_dist_index_js-node_modules_scroll-anchoring_dist_scro-52dc4b-e1e33bfc0b7e.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_color-convert_index_js-35b3ae68c408.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_paste-markdown_dist_index_esm_js-node_modules_github_quote-select-7a8e2b-f036384374ea.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/ui_packages_form-utils_form-utils_ts-ui_packages_morpheus_index_ts-ui_packages_trusted-types--01a936-2e33af2596e0.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/app_assets_modules_github_behaviors_keyboard-shortcuts-helper_ts-app_assets_modules_github_be-af52ef-a7d8c6f40fcc.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/app_assets_modules_github_sticky-scroll-into-view_ts-050ad6637d58.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/app_assets_modules_github_behaviors_ajax-error_ts-app_assets_modules_github_behaviors_include-f12a82-c9c7859d8645.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/app_assets_modules_github_behaviors_commenting_edit_ts-app_assets_modules_github_behaviors_ht-83c235-f22ac6b94445.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/app_assets_modules_github_blob-anchor_ts-app_assets_modules_github_filter-sort_ts-app_assets_-c96432-3460172f1b1f.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/behaviors-3e5c93992bc3.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_delegated-events_dist_index_js-node_modules_github_catalyst_lib_index_js-06ff531-fe0b8ccc90a5.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/notifications-global-f57687007bfc.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_optimizely_optimizely-sdk_dist_optimizely_browser_es_min_js-node_modules-089adc-2328ba323205.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/optimizely-26ff2afd6edd.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_virtualized-list_es_index_js-node_modules_github_template-parts_lib_index_js-677582870bfd.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_remote-form_dist_index_js-node_modules_delegated-events_dist_inde-c537341-c7299eece475.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/app_assets_modules_github_ref-selector_ts-0e2b12902d39.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/codespaces-4975e3c146a1.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_mini-throttle_dist_decorators_js-node_modules_github_remote-form_-01f9fa-9132628fb196.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_file-attachment-element_dist_index_js-node_modules_github_filter--b2311f-939ba5085db0.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/repositories-9a72fd89c2e9.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_remote-form_dist_index_js-node_modules_delegated-events_dist_inde-0e9dbe-6435366f0862.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/topic-suggestions-df13cff9c1c3.js"></script>
    <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/code-menu-082003a113a7.js"></script>


    <title>GitHub - restinpc/DAO</title>



    <meta name="route-pattern" content="/:user_id/:repository">


    <meta name="current-catalog-service-hash" content="82c569b93da5c18ed649ebd4c2c79437db4611a6a1373e805a3cb001c64130b7">


    <meta name="request-id" content="B6C2:DAF9:1B38928:1BBB280:649D397C" data-pjax-transient="true"/><meta name="html-safe-nonce" content="385442c6cfc506d6848c6d33b1670578417149db1a7000bbc3a87771e7d9023f" data-pjax-transient="true"/><meta name="visitor-payload" content="eyJyZWZlcnJlciI6IiIsInJlcXVlc3RfaWQiOiJCNkMyOkRBRjk6MUIzODkyODoxQkJCMjgwOjY0OUQzOTdDIiwidmlzaXRvcl9pZCI6IjQ1NTA0MDMzNTY1NjE4NDg3MDAiLCJyZWdpb25fZWRnZSI6ImZyYSIsInJlZ2lvbl9yZW5kZXIiOiJmcmEifQ==" data-pjax-transient="true"/><meta name="visitor-hmac" content="2ef79c64ac337d75bbee39f173b1983846bca2c2bf5e2515ae4565e80afe75ff" data-pjax-transient="true"/>


    <meta name="hovercard-subject-tag" content="repository:605534044" data-turbo-transient>


    <meta name="github-keyboard-shortcuts" content="repository" data-turbo-transient="true" />


    <meta name="selected-link" value="repo_source" data-turbo-transient>
    <link rel="assets" href="https://github.githubassets.com/">

    <meta name="google-site-verification" content="c1kuD-K2HIVF635lypcsWPoD4kilo5-jA_wBFyT4uMY">
    <meta name="google-site-verification" content="KT5gs8h0wvaagLKAVWq8bbeNwnZZK1r1XQysX3xurLU">
    <meta name="google-site-verification" content="ZzhVyEFwb7w3e0-uOTltm8Jsck2F5StVihD0exw2fsA">
    <meta name="google-site-verification" content="GXs5KoUUkNCoaAZn7wPN-t01Pywp9M3sEjnt_3_ZWPc">
    <meta name="google-site-verification" content="Apib7-x98H0j5cPqHWwSMm6dNU4GmODRoqxLiDzdx9I">

    <meta name="octolytics-url" content="https://collector.github.com/github/collect" />

    <meta name="analytics-location" content="/&lt;user-name&gt;/&lt;repo-name&gt;" data-turbo-transient="true" />








    <meta name="user-login" content="">



    <meta name="viewport" content="width=device-width">

    <meta name="description" content="Contribute to restinpc/DAO development by creating an account on GitHub.">
    <link rel="search" type="application/opensearchdescription+xml" target="_blank" href="https://github.com/opensearch.xml" title="GitHub">
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub">
    <meta property="fb:app_id" content="1401488693436528">
    <meta name="apple-itunes-app" content="app-id=1477376905, app-argument=https://github.com/restinpc/DAO" />
    <meta name="twitter:image:src" content="https://opengraph.githubassets.com/c7d3c79fe96c33bee86ea9c0fb0f228b2a06d92263f3fb97d44ff4692f1a0236/restinpc/DAO" /><meta name="twitter:site" content="@github" /><meta name="twitter:card" content="summary_large_image" /><meta name="twitter:title" content="GitHub - restinpc/DAO" /><meta name="twitter:description" content="Contribute to restinpc/DAO development by creating an account on GitHub." />
    <meta property="og:image" content="https://opengraph.githubassets.com/c7d3c79fe96c33bee86ea9c0fb0f228b2a06d92263f3fb97d44ff4692f1a0236/restinpc/DAO" /><meta property="og:image:alt" content="Contribute to restinpc/DAO development by creating an account on GitHub." /><meta property="og:image:width" content="1200" /><meta property="og:image:height" content="600" /><meta property="og:site_name" content="GitHub" /><meta property="og:type" content="object" /><meta property="og:title" content="GitHub - restinpc/DAO" /><meta property="og:url" content="https://github.com/restinpc/DAO" /><meta property="og:description" content="Contribute to restinpc/DAO development by creating an account on GitHub." />




    <meta name="hostname" content="github.com">



    <meta name="expected-hostname" content="github.com">

    <meta name="enabled-features" content="TURBO_EXPERIMENT_RISKY,IMAGE_METRIC_TRACKING,GEOJSON_AZURE_MAPS">


    <meta http-equiv="x-pjax-version" content="45b01eeb3a5b4fe1063dbab21fc454b55b77960bde33d5f1d06aec9d24cd1884" data-turbo-track="reload">
    <meta http-equiv="x-pjax-csp-version" content="0db263f9a873141d8256f783c35f244c06d490aacc3b680f99794dd8fd59fb59" data-turbo-track="reload">
    <meta http-equiv="x-pjax-css-version" content="d7827b6c4cdb674702c8a883ee2d5739d153d7f3ff3a61fdbf83a65f07f0ccae" data-turbo-track="reload">
    <meta http-equiv="x-pjax-js-version" content="25feb9d2db400ceeea2bd738b341c434fc587039ca9c3cbdac46bc359a3ae7cf" data-turbo-track="reload">

    <meta name="turbo-cache-control" content="no-preview" data-turbo-transient="">


    <meta name="go-import" content="github.com/restinpc/DAO git https://github.com/restinpc/DAO.git">

    <meta name="octolytics-dimension-user_id" content="20625743" /><meta name="octolytics-dimension-user_login" content="restinpc" /><meta name="octolytics-dimension-repository_id" content="605534044" /><meta name="octolytics-dimension-repository_nwo" content="restinpc/DAO" /><meta name="octolytics-dimension-repository_public" content="true" /><meta name="octolytics-dimension-repository_is_fork" content="false" /><meta name="octolytics-dimension-repository_network_root_id" content="605534044" /><meta name="octolytics-dimension-repository_network_root_nwo" content="restinpc/DAO" />



    <link rel="canonical" href="https://github.com/restinpc/DAO" data-turbo-transient>
    <meta name="turbo-body-classes" content="logged-out env-production page-responsive">


    <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">

    <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">

    <meta name="browser-optimizely-client-errors-url" content="https://api.github.com/_private/browser/optimizely_client/errors">

    <link rel="mask-icon" href="https://github.githubassets.com/pinned-octocat.svg" color="#000000">
    <link rel="alternate icon" class="js-site-favicon" type="image/png" href="https://github.githubassets.com/favicons/favicon.png">
    <link rel="icon" class="js-site-favicon" type="image/svg+xml" href="https://github.githubassets.com/favicons/favicon.svg">

    <meta name="theme-color" content="#1e2327">
    <meta name="color-scheme" content="light dark" />


    <link rel="manifest" target="_blank" href="https://github.com/manifest.json" crossOrigin="use-credentials">

</head>

<body class="logged-out env-production page-responsive" style="word-wrap: break-word;">
<div data-turbo-body class="logged-out env-production page-responsive" style="word-wrap: break-word;">



    <div class="position-relative js-header-wrapper ">
        <a href="#start-of-content" class="px-2 py-4 color-bg-accent-emphasis color-fg-on-emphasis show-on-focus js-skip-to-content">Skip to content</a>
        <span data-view-component="true" class="progress-pjax-loader Progress position-fixed width-full">
    <span style="width: 0%;" data-view-component="true" class="Progress-item progress-pjax-loader-bar left-0 top-0 color-bg-accent-emphasis"></span>
</span>





        <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/vendors-node_modules_github_remote-form_dist_index_js-node_modules_github_memoize_dist_esm_in-687f35-d131f0b6de8e.js"></script>
        <script crossorigin="anonymous" defer="defer" type="application/javascript" src="https://github.githubassets.com/assets/sessions-2638decb9ee5.js"></script>


        <div hidden="hidden" data-view-component="true" class="js-stale-session-flash flash flash-warn mb-3">

            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-alert">
                <path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
            </svg>
            <span class="js-stale-session-flash-signed-in" hidden>You signed in with another tab or window. <a href="">Reload</a> to refresh your session.</span>
            <span class="js-stale-session-flash-signed-out" hidden>You signed out in another tab or window. <a href="">Reload</a> to refresh your session.</span>
            <span class="js-stale-session-flash-switched" hidden>You switched accounts on another tab or window. <a href="">Reload</a> to refresh your session.</span>

            <button class="flash-close js-flash-close" type="button" aria-label="Close">
                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-x">
                    <path d="M3.72 3.72a.75.75 0 0 1 1.06 0L8 6.94l3.22-3.22a.749.749 0 0 1 1.275.326.749.749 0 0 1-.215.734L9.06 8l3.22 3.22a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215L8 9.06l-3.22 3.22a.751.751 0 0 1-1.042-.018.751.751 0 0 1-.018-1.042L6.94 8 3.72 4.78a.75.75 0 0 1 0-1.06Z"></path>
                </svg>
            </button>


        </div>
    </div>

    <div id="start-of-content" class="show-on-focus"></div>








    <div id="js-flash-container" data-turbo-replace>





        <template class="js-flash-template">

            <div class="flash flash-full   {{ className }}">
                <div class="px-2" >
                    <button autofocus class="flash-close js-flash-close" type="button" aria-label="Dismiss this message">
                        <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-x">
                            <path d="M3.72 3.72a.75.75 0 0 1 1.06 0L8 6.94l3.22-3.22a.749.749 0 0 1 1.275.326.749.749 0 0 1-.215.734L9.06 8l3.22 3.22a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215L8 9.06l-3.22 3.22a.751.751 0 0 1-1.042-.018.751.751 0 0 1-.018-1.042L6.94 8 3.72 4.78a.75.75 0 0 1 0-1.06Z"></path>
                        </svg>
                    </button>
                    <div aria-atomic="true" role="alert" class="js-flash-alert">

                        <div>{{ message }}</div>

                    </div>
                </div>
            </div>
        </template>
    </div>



    <include-fragment class="js-notification-shelf-include-fragment" data-base-src="https://github.com/notifications/beta/shelf"></include-fragment>






    <div
        class="application-main "
        data-commit-hovercards-enabled
        data-discussion-hovercards-enabled
        data-issue-and-pr-hovercards-enabled
    >
        <div itemscope itemtype="http://schema.org/SoftwareSourceCode" class="">
            <main id="js-repo-pjax-container" >














                <div id="repository-container-header"  class="pt-3 hide-full-screen" style="background-color: var(--color-page-header-bg);" data-turbo-replace>

                    <div class="d-flex flex-wrap flex-justify-end mb-3  px-3 px-md-4 px-lg-5" style="gap: 1rem;">

                        <div class="flex-auto min-width-0 width-fit mr-3">

                            <div class=" d-flex flex-wrap flex-items-center wb-break-word f3 text-normal">
                                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-repo color-fg-muted mr-2">
                                    <path d="M2 2.5A2.5 2.5 0 0 1 4.5 0h8.75a.75.75 0 0 1 .75.75v12.5a.75.75 0 0 1-.75.75h-2.5a.75.75 0 0 1 0-1.5h1.75v-2h-8a1 1 0 0 0-.714 1.7.75.75 0 1 1-1.072 1.05A2.495 2.495 0 0 1 2 11.5Zm10.5-1h-8a1 1 0 0 0-1 1v6.708A2.486 2.486 0 0 1 4.5 9h8ZM5 12.25a.25.25 0 0 1 .25-.25h3.5a.25.25 0 0 1 .25.25v3.25a.25.25 0 0 1-.4.2l-1.45-1.087a.249.249 0 0 0-.3 0L5.4 15.7a.25.25 0 0 1-.4-.2Z"></path>
                                </svg>

                                <span class="author flex-self-stretch" itemprop="author">
      <a class="url fn" rel="author" data-hovercard-type="user" data-hovercard-url="/users/restinpc/hovercard" data-octo-click="hovercard-link-click" data-octo-dimensions="link_type:self" target="_blank" href="https://github.com/restinpc">
        restinpc
</a>    </span>
                                <span class="mx-1 flex-self-stretch color-fg-muted">/</span>
                                <strong itemprop="name" class="mr-2 flex-self-stretch">
                                    <a data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO">DAO</a>
                                </strong>

                                <span></span><span class="Label Label--secondary v-align-middle mr-1">Public</span>
                            </div>


                        </div>

                        <div id="repository-details-container" data-turbo-replace>
                            <ul class="pagehead-actions flex-shrink-0 d-none d-md-inline" style="padding: 2px 0;">



                                <li>
                                    <a target="_blank" href="https://github.com/login?return_to=%2Frestinpc%2FDAO" rel="nofollow" data-hydro-click="{&quot;event_type&quot;:&quot;authentication.click&quot;,&quot;payload&quot;:{&quot;location_in_page&quot;:&quot;notification subscription menu watch&quot;,&quot;repository_id&quot;:null,&quot;auth_type&quot;:&quot;LOG_IN&quot;,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="a6adcae442e5993372053e8d8348bde6a5bc0708a491c8f131a2d4789b40d422" aria-label="You must be signed in to change notification settings" data-view-component="true" class="tooltipped tooltipped-s btn-sm btn">    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-bell mr-2">
                                            <path d="M8 16a2 2 0 0 0 1.985-1.75c.017-.137-.097-.25-.235-.25h-3.5c-.138 0-.252.113-.235.25A2 2 0 0 0 8 16ZM3 5a5 5 0 0 1 10 0v2.947c0 .05.015.098.042.139l1.703 2.555A1.519 1.519 0 0 1 13.482 13H2.518a1.516 1.516 0 0 1-1.263-2.36l1.703-2.554A.255.255 0 0 0 3 7.947Zm5-3.5A3.5 3.5 0 0 0 4.5 5v2.947c0 .346-.102.683-.294.97l-1.703 2.556a.017.017 0 0 0-.003.01l.001.006c0 .002.002.004.004.006l.006.004.007.001h10.964l.007-.001.006-.004.004-.006.001-.007a.017.017 0 0 0-.003-.01l-1.703-2.554a1.745 1.745 0 0 1-.294-.97V5A3.5 3.5 0 0 0 8 1.5Z"></path>
                                        </svg>Notifications
                                    </a>
                                </li>

                                <li>
                                    <a icon="repo-forked" id="fork-button" target="_blank" href="https://github.com/login?return_to=%2Frestinpc%2FDAO" rel="nofollow" data-hydro-click="{&quot;event_type&quot;:&quot;authentication.click&quot;,&quot;payload&quot;:{&quot;location_in_page&quot;:&quot;repo details fork button&quot;,&quot;repository_id&quot;:605534044,&quot;auth_type&quot;:&quot;LOG_IN&quot;,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="51eb1b0376dd754a6912dbb6c8e3e05a919e44c8ace8cd12d4fc8a4a4b3fc860" data-view-component="true" class="btn-sm btn">    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-repo-forked mr-2">
                                            <path d="M5 5.372v.878c0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75v-.878a2.25 2.25 0 1 1 1.5 0v.878a2.25 2.25 0 0 1-2.25 2.25h-1.5v2.128a2.251 2.251 0 1 1-1.5 0V8.5h-1.5A2.25 2.25 0 0 1 3.5 6.25v-.878a2.25 2.25 0 1 1 1.5 0ZM5 3.25a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Zm6.75.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm-3 8.75a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Z"></path>
                                        </svg>Fork
                                        <span id="repo-network-counter" data-pjax-replace="true" data-turbo-replace="true" title="1" data-view-component="true" class="Counter">1</span>
                                    </a>
                                </li>

                                <li>
                                    <div data-view-component="true" class="BtnGroup d-flex">
                                        <a target="_blank" href="https://github.com/login?return_to=%2Frestinpc%2FDAO" rel="nofollow" data-hydro-click="{&quot;event_type&quot;:&quot;authentication.click&quot;,&quot;payload&quot;:{&quot;location_in_page&quot;:&quot;star button&quot;,&quot;repository_id&quot;:605534044,&quot;auth_type&quot;:&quot;LOG_IN&quot;,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="a09f7a0b9d28af8bc7a5f16f4200802c9ce891eee2639d7595f7ace36a9e09c3" aria-label="You must be signed in to star a repository" data-view-component="true" class="tooltipped tooltipped-s btn-sm btn BtnGroup-item">    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-star v-align-text-bottom d-inline-block mr-2">
                                                <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Zm0 2.445L6.615 5.5a.75.75 0 0 1-.564.41l-3.097.45 2.24 2.184a.75.75 0 0 1 .216.664l-.528 3.084 2.769-1.456a.75.75 0 0 1 .698 0l2.77 1.456-.53-3.084a.75.75 0 0 1 .216-.664l2.24-2.183-3.096-.45a.75.75 0 0 1-.564-.41L8 2.694Z"></path>
                                            </svg><span data-view-component="true" class="d-inline">
          Star
</span>          <span id="repo-stars-counter-star" aria-label="0 users starred this repository" data-singular-suffix="user starred this repository" data-plural-suffix="users starred this repository" data-turbo-replace="true" title="0" data-view-component="true" class="Counter js-social-count">0</span>
                                        </a>        <button aria-label="You must be signed in to add this repository to a list" type="button" disabled="disabled" data-view-component="true" class="btn-sm btn BtnGroup-item px-2">    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-triangle-down">
                                                <path d="m4.427 7.427 3.396 3.396a.25.25 0 0 0 .354 0l3.396-3.396A.25.25 0 0 0 11.396 7H4.604a.25.25 0 0 0-.177.427Z"></path>
                                            </svg>
                                        </button></div>
                                </li>




                            </ul>

                        </div>
                    </div>

                    <div id="responsive-meta-container" data-turbo-replace>
                        <div class="d-block d-md-none mb-2 px-3 px-md-4 px-lg-5">



                            <div class="mb-3">
                                <a class="Link--secondary no-underline mr-3" target="_blank" href="https://github.com/restinpc/DAO/stargazers">
                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-star mr-1">
                                        <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Zm0 2.445L6.615 5.5a.75.75 0 0 1-.564.41l-3.097.45 2.24 2.184a.75.75 0 0 1 .216.664l-.528 3.084 2.769-1.456a.75.75 0 0 1 .698 0l2.77 1.456-.53-3.084a.75.75 0 0 1 .216-.664l2.24-2.183-3.096-.45a.75.75 0 0 1-.564-.41L8 2.694Z"></path>
                                    </svg>
                                    <span class="text-bold">0</span>
                                    stars
                                </a>        <a class="Link--secondary no-underline mr-3" target="_blank" href="https://github.com/restinpc/DAO/forks">
                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-repo-forked mr-1">
                                        <path d="M5 5.372v.878c0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75v-.878a2.25 2.25 0 1 1 1.5 0v.878a2.25 2.25 0 0 1-2.25 2.25h-1.5v2.128a2.251 2.251 0 1 1-1.5 0V8.5h-1.5A2.25 2.25 0 0 1 3.5 6.25v-.878a2.25 2.25 0 1 1 1.5 0ZM5 3.25a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Zm6.75.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm-3 8.75a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Z"></path>
                                    </svg>
                                    <span class="text-bold">1</span>
                                    fork
                                </a>    </div>

                            <div class="d-flex flex-wrap gap-2">
                                <div class="flex-1">
                                    <div data-view-component="true" class="BtnGroup d-flex">
                                        <a target="_blank" href="https://github.com/login?return_to=%2Frestinpc%2FDAO" rel="nofollow" data-hydro-click="{&quot;event_type&quot;:&quot;authentication.click&quot;,&quot;payload&quot;:{&quot;location_in_page&quot;:&quot;star button&quot;,&quot;repository_id&quot;:605534044,&quot;auth_type&quot;:&quot;LOG_IN&quot;,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="a09f7a0b9d28af8bc7a5f16f4200802c9ce891eee2639d7595f7ace36a9e09c3" aria-label="You must be signed in to star a repository" data-view-component="true" class="tooltipped tooltipped-s btn-sm btn btn-block BtnGroup-item">    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-star v-align-text-bottom d-inline-block mr-2">
                                                <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Zm0 2.445L6.615 5.5a.75.75 0 0 1-.564.41l-3.097.45 2.24 2.184a.75.75 0 0 1 .216.664l-.528 3.084 2.769-1.456a.75.75 0 0 1 .698 0l2.77 1.456-.53-3.084a.75.75 0 0 1 .216-.664l2.24-2.183-3.096-.45a.75.75 0 0 1-.564-.41L8 2.694Z"></path>
                                            </svg><span data-view-component="true" class="d-inline">
          Star
</span>
                                        </a>        <button aria-label="You must be signed in to add this repository to a list" type="button" disabled="disabled" data-view-component="true" class="btn-sm btn BtnGroup-item px-2">    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-triangle-down">
                                                <path d="m4.427 7.427 3.396 3.396a.25.25 0 0 0 .354 0l3.396-3.396A.25.25 0 0 0 11.396 7H4.604a.25.25 0 0 0-.177.427Z"></path>
                                            </svg>
                                        </button></div>
                                </div>
                                <div class="flex-1">
                                    <a target="_blank" href="https://github.com/login?return_to=%2Frestinpc%2FDAO" rel="nofollow" data-hydro-click="{&quot;event_type&quot;:&quot;authentication.click&quot;,&quot;payload&quot;:{&quot;location_in_page&quot;:&quot;notification subscription menu watch&quot;,&quot;repository_id&quot;:null,&quot;auth_type&quot;:&quot;LOG_IN&quot;,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="a6adcae442e5993372053e8d8348bde6a5bc0708a491c8f131a2d4789b40d422" aria-label="You must be signed in to change notification settings" data-view-component="true" class="tooltipped tooltipped-s btn-sm btn btn-block">    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-bell mr-2">
                                            <path d="M8 16a2 2 0 0 0 1.985-1.75c.017-.137-.097-.25-.235-.25h-3.5c-.138 0-.252.113-.235.25A2 2 0 0 0 8 16ZM3 5a5 5 0 0 1 10 0v2.947c0 .05.015.098.042.139l1.703 2.555A1.519 1.519 0 0 1 13.482 13H2.518a1.516 1.516 0 0 1-1.263-2.36l1.703-2.554A.255.255 0 0 0 3 7.947Zm5-3.5A3.5 3.5 0 0 0 4.5 5v2.947c0 .346-.102.683-.294.97l-1.703 2.556a.017.017 0 0 0-.003.01l.001.006c0 .002.002.004.004.006l.006.004.007.001h10.964l.007-.001.006-.004.004-.006.001-.007a.017.017 0 0 0-.003-.01l-1.703-2.554a1.745 1.745 0 0 1-.294-.97V5A3.5 3.5 0 0 0 8 1.5Z"></path>
                                        </svg>Notifications
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>


                    <nav data-pjax="#js-repo-pjax-container" aria-label="Repository" data-view-component="true" class="js-repo-nav js-sidenav-container-pjax js-responsive-underlinenav overflow-hidden UnderlineNav px-3 px-md-4 px-lg-5">

                        <ul data-view-component="true" class="UnderlineNav-body list-style-none">
                            <li data-view-component="true" class="d-inline-flex">
                                <a id="code-tab" target="_blank" href="https://github.com/restinpc/DAO" data-tab-item="i0code-tab" data-selected-links="repo_source repo_downloads repo_commits repo_releases repo_tags repo_branches repo_packages repo_deployments /restinpc/DAO" data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" data-hotkey="g c" data-analytics-event="{&quot;category&quot;:&quot;Underline navbar&quot;,&quot;action&quot;:&quot;Click tab&quot;,&quot;label&quot;:&quot;Code&quot;,&quot;target&quot;:&quot;UNDERLINE_NAV.TAB&quot;}" aria-current="page" data-view-component="true" class="UnderlineNav-item no-wrap js-responsive-underlinenav-item js-selected-navigation-item selected">

                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-code UnderlineNav-octicon d-none d-sm-inline">
                                        <path d="m11.28 3.22 4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.749.749 0 0 1-1.275-.326.749.749 0 0 1 .215-.734L13.94 8l-3.72-3.72a.749.749 0 0 1 .326-1.275.749.749 0 0 1 .734.215Zm-6.56 0a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042L2.06 8l3.72 3.72a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215L.47 8.53a.75.75 0 0 1 0-1.06Z"></path>
                                    </svg>
                                    <span data-content="Code">Code</span>
                                    <span id="code-repo-tab-count" data-pjax-replace="" data-turbo-replace="" title="Not available" data-view-component="true" class="Counter"></span>



                                </a></li>
                            <li data-view-component="true" class="d-inline-flex">
                                <a id="issues-tab" target="_blank" href="https://github.com/restinpc/DAO/issues" data-tab-item="i1issues-tab" data-selected-links="repo_issues repo_labels repo_milestones /restinpc/DAO/issues" data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" data-hotkey="g i" data-analytics-event="{&quot;category&quot;:&quot;Underline navbar&quot;,&quot;action&quot;:&quot;Click tab&quot;,&quot;label&quot;:&quot;Issues&quot;,&quot;target&quot;:&quot;UNDERLINE_NAV.TAB&quot;}" data-view-component="true" class="UnderlineNav-item no-wrap js-responsive-underlinenav-item js-selected-navigation-item">

                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-issue-opened UnderlineNav-octicon d-none d-sm-inline">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"></path><path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0ZM1.5 8a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0Z"></path>
                                    </svg>
                                    <span data-content="Issues">Issues</span>
                                    <span id="issues-repo-tab-count" data-pjax-replace="" data-turbo-replace="" title="0" hidden="hidden" data-view-component="true" class="Counter">0</span>



                                </a></li>
                            <li data-view-component="true" class="d-inline-flex">
                                <a id="pull-requests-tab" target="_blank" href="https://github.com/restinpc/DAO/pulls" data-tab-item="i2pull-requests-tab" data-selected-links="repo_pulls checks /restinpc/DAO/pulls" data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" data-hotkey="g p" data-analytics-event="{&quot;category&quot;:&quot;Underline navbar&quot;,&quot;action&quot;:&quot;Click tab&quot;,&quot;label&quot;:&quot;Pull requests&quot;,&quot;target&quot;:&quot;UNDERLINE_NAV.TAB&quot;}" data-view-component="true" class="UnderlineNav-item no-wrap js-responsive-underlinenav-item js-selected-navigation-item">

                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-git-pull-request UnderlineNav-octicon d-none d-sm-inline">
                                        <path d="M1.5 3.25a2.25 2.25 0 1 1 3 2.122v5.256a2.251 2.251 0 1 1-1.5 0V5.372A2.25 2.25 0 0 1 1.5 3.25Zm5.677-.177L9.573.677A.25.25 0 0 1 10 .854V2.5h1A2.5 2.5 0 0 1 13.5 5v5.628a2.251 2.251 0 1 1-1.5 0V5a1 1 0 0 0-1-1h-1v1.646a.25.25 0 0 1-.427.177L7.177 3.427a.25.25 0 0 1 0-.354ZM3.75 2.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm0 9.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm8.25.75a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Z"></path>
                                    </svg>
                                    <span data-content="Pull requests">Pull requests</span>
                                    <span id="pull-requests-repo-tab-count" data-pjax-replace="" data-turbo-replace="" title="0" hidden="hidden" data-view-component="true" class="Counter">0</span>



                                </a></li>
                            <li data-view-component="true" class="d-inline-flex">
                                <a id="actions-tab" target="_blank" href="https://github.com/restinpc/DAO/actions" data-tab-item="i3actions-tab" data-selected-links="repo_actions /restinpc/DAO/actions" data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" data-hotkey="g a" data-analytics-event="{&quot;category&quot;:&quot;Underline navbar&quot;,&quot;action&quot;:&quot;Click tab&quot;,&quot;label&quot;:&quot;Actions&quot;,&quot;target&quot;:&quot;UNDERLINE_NAV.TAB&quot;}" data-view-component="true" class="UnderlineNav-item no-wrap js-responsive-underlinenav-item js-selected-navigation-item">

                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-play UnderlineNav-octicon d-none d-sm-inline">
                                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0ZM1.5 8a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0Zm4.879-2.773 4.264 2.559a.25.25 0 0 1 0 .428l-4.264 2.559A.25.25 0 0 1 6 10.559V5.442a.25.25 0 0 1 .379-.215Z"></path>
                                    </svg>
                                    <span data-content="Actions">Actions</span>
                                    <span id="actions-repo-tab-count" data-pjax-replace="" data-turbo-replace="" title="Not available" data-view-component="true" class="Counter"></span>



                                </a></li>
                            <li data-view-component="true" class="d-inline-flex">
                                <a id="projects-tab" target="_blank" href="https://github.com/restinpc/DAO/projects" data-tab-item="i4projects-tab" data-selected-links="repo_projects new_repo_project repo_project /restinpc/DAO/projects" data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" data-hotkey="g b" data-analytics-event="{&quot;category&quot;:&quot;Underline navbar&quot;,&quot;action&quot;:&quot;Click tab&quot;,&quot;label&quot;:&quot;Projects&quot;,&quot;target&quot;:&quot;UNDERLINE_NAV.TAB&quot;}" data-view-component="true" class="UnderlineNav-item no-wrap js-responsive-underlinenav-item js-selected-navigation-item">

                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-table UnderlineNav-octicon d-none d-sm-inline">
                                        <path d="M0 1.75C0 .784.784 0 1.75 0h12.5C15.216 0 16 .784 16 1.75v12.5A1.75 1.75 0 0 1 14.25 16H1.75A1.75 1.75 0 0 1 0 14.25ZM6.5 6.5v8h7.75a.25.25 0 0 0 .25-.25V6.5Zm8-1.5V1.75a.25.25 0 0 0-.25-.25H6.5V5Zm-13 1.5v7.75c0 .138.112.25.25.25H5v-8ZM5 5V1.5H1.75a.25.25 0 0 0-.25.25V5Z"></path>
                                    </svg>
                                    <span data-content="Projects">Projects</span>
                                    <span id="projects-repo-tab-count" data-pjax-replace="" data-turbo-replace="" title="0" hidden="hidden" data-view-component="true" class="Counter">0</span>



                                </a></li>
                            <li data-view-component="true" class="d-inline-flex">
                                <a id="security-tab" target="_blank" href="https://github.com/restinpc/DAO/security" data-tab-item="i5security-tab" data-selected-links="security overview alerts policy token_scanning code_scanning /restinpc/DAO/security" data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" data-hotkey="g s" data-analytics-event="{&quot;category&quot;:&quot;Underline navbar&quot;,&quot;action&quot;:&quot;Click tab&quot;,&quot;label&quot;:&quot;Security&quot;,&quot;target&quot;:&quot;UNDERLINE_NAV.TAB&quot;}" data-view-component="true" class="UnderlineNav-item no-wrap js-responsive-underlinenav-item js-selected-navigation-item">

                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-shield UnderlineNav-octicon d-none d-sm-inline">
                                        <path d="M7.467.133a1.748 1.748 0 0 1 1.066 0l5.25 1.68A1.75 1.75 0 0 1 15 3.48V7c0 1.566-.32 3.182-1.303 4.682-.983 1.498-2.585 2.813-5.032 3.855a1.697 1.697 0 0 1-1.33 0c-2.447-1.042-4.049-2.357-5.032-3.855C1.32 10.182 1 8.566 1 7V3.48a1.75 1.75 0 0 1 1.217-1.667Zm.61 1.429a.25.25 0 0 0-.153 0l-5.25 1.68a.25.25 0 0 0-.174.238V7c0 1.358.275 2.666 1.057 3.86.784 1.194 2.121 2.34 4.366 3.297a.196.196 0 0 0 .154 0c2.245-.956 3.582-2.104 4.366-3.298C13.225 9.666 13.5 8.36 13.5 7V3.48a.251.251 0 0 0-.174-.237l-5.25-1.68ZM8.75 4.75v3a.75.75 0 0 1-1.5 0v-3a.75.75 0 0 1 1.5 0ZM9 10.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
                                    </svg>
                                    <span data-content="Security">Security</span>
                                    <include-fragment accept="text/fragment+html"></include-fragment>


                                </a></li>
                            <li data-view-component="true" class="d-inline-flex">
                                <a id="insights-tab" target="_blank" href="https://github.com/restinpc/DAO/pulse" data-tab-item="i6insights-tab" data-selected-links="repo_graphs repo_contributors dependency_graph dependabot_updates pulse people community /restinpc/DAO/pulse" data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" data-analytics-event="{&quot;category&quot;:&quot;Underline navbar&quot;,&quot;action&quot;:&quot;Click tab&quot;,&quot;label&quot;:&quot;Insights&quot;,&quot;target&quot;:&quot;UNDERLINE_NAV.TAB&quot;}" data-view-component="true" class="UnderlineNav-item no-wrap js-responsive-underlinenav-item js-selected-navigation-item">

                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-graph UnderlineNav-octicon d-none d-sm-inline">
                                        <path d="M1.5 1.75V13.5h13.75a.75.75 0 0 1 0 1.5H.75a.75.75 0 0 1-.75-.75V1.75a.75.75 0 0 1 1.5 0Zm14.28 2.53-5.25 5.25a.75.75 0 0 1-1.06 0L7 7.06 4.28 9.78a.751.751 0 0 1-1.042-.018.751.751 0 0 1-.018-1.042l3.25-3.25a.75.75 0 0 1 1.06 0L10 7.94l4.72-4.72a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042Z"></path>
                                    </svg>
                                    <span data-content="Insights">Insights</span>
                                    <span id="insights-repo-tab-count" data-pjax-replace="" data-turbo-replace="" title="Not available" data-view-component="true" class="Counter"></span>



                                </a></li>
                        </ul>
                        <div style="visibility:hidden;" data-view-component="true" class="UnderlineNav-actions js-responsive-underlinenav-overflow position-absolute pr-3 pr-md-4 pr-lg-5 right-0">        <details data-view-component="true" class="details-overlay details-reset position-relative">
                                <summary role="button" data-view-component="true">          <div class="UnderlineNav-item mr-0 border-0">
                                        <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-kebab-horizontal">
                                            <path d="M8 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM1.5 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm13 0a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"></path>
                                        </svg>
                                        <span class="sr-only">More</span>
                                    </div>
                                </summary>
                                <details-menu role="menu" data-view-component="true" class="dropdown-menu dropdown-menu-sw">          <ul>
                                        <li data-menu-item="i0code-tab" hidden>
                                            <a role="menuitem" class="js-selected-navigation-item selected dropdown-item" aria-current="page" data-selected-links="repo_source repo_downloads repo_commits repo_releases repo_tags repo_branches repo_packages repo_deployments /restinpc/DAO" target="_blank" href="https://github.com/restinpc/DAO">
                                                Code
                                            </a>              </li>
                                        <li data-menu-item="i1issues-tab" hidden>
                                            <a role="menuitem" class="js-selected-navigation-item dropdown-item" data-selected-links="repo_issues repo_labels repo_milestones /restinpc/DAO/issues" target="_blank" href="https://github.com/restinpc/DAO/issues">
                                                Issues
                                            </a>              </li>
                                        <li data-menu-item="i2pull-requests-tab" hidden>
                                            <a role="menuitem" class="js-selected-navigation-item dropdown-item" data-selected-links="repo_pulls checks /restinpc/DAO/pulls" target="_blank" href="https://github.com/restinpc/DAO/pulls">
                                                Pull requests
                                            </a>              </li>
                                        <li data-menu-item="i3actions-tab" hidden>
                                            <a role="menuitem" class="js-selected-navigation-item dropdown-item" data-selected-links="repo_actions /restinpc/DAO/actions" target="_blank" href="https://github.com/restinpc/DAO/actions">
                                                Actions
                                            </a>              </li>
                                        <li data-menu-item="i4projects-tab" hidden>
                                            <a role="menuitem" class="js-selected-navigation-item dropdown-item" data-selected-links="repo_projects new_repo_project repo_project /restinpc/DAO/projects" target="_blank" href="https://github.com/restinpc/DAO/projects">
                                                Projects
                                            </a>              </li>
                                        <li data-menu-item="i5security-tab" hidden>
                                            <a role="menuitem" class="js-selected-navigation-item dropdown-item" data-selected-links="security overview alerts policy token_scanning code_scanning /restinpc/DAO/security" target="_blank" href="https://github.com/restinpc/DAO/security">
                                                Security
                                            </a>              </li>
                                        <li data-menu-item="i6insights-tab" hidden>
                                            <a role="menuitem" class="js-selected-navigation-item dropdown-item" data-selected-links="repo_graphs repo_contributors dependency_graph dependabot_updates pulse people community /restinpc/DAO/pulse" target="_blank" href="https://github.com/restinpc/DAO/pulse">
                                                Insights
                                            </a>              </li>
                                    </ul>
                                </details-menu>
                            </details></div>
                    </nav>

                </div>





                <turbo-frame id="repo-content-turbo-frame" target="_top" data-turbo-action="advance" class="">
                    <div id="repo-content-pjax-container" class="repository-content " >





                        <h1 class='sr-only'>restinpc/DAO</h1>
                        <div class="clearfix container-xl mt-4 px-md-4 px-lg-5 px-3">


                            <div>



                                <div id="spoof-warning" class="mt-0 pb-3" hidden aria-hidden>
                                    <div data-view-component="true" class="flash flash-warn mt-0 clearfix">

                                        <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-alert float-left mt-1">
                                            <path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
                                        </svg>

                                        <div class="overflow-hidden">This commit does not belong to any branch on this repository, and may belong to a fork outside of the repository.</div>



                                    </div></div>

                                <include-fragment data-test-selector="spoofed-commit-check"></include-fragment>

                                <div data-view-component="true" class="Layout Layout--flowRow-until-md Layout--sidebarPosition-end Layout--sidebarPosition-flowRow-end">
                                    <div data-view-component="true" class="Layout-main">

                                        <div class="file-navigation mb-3 d-flex flex-items-start">

                                            <div class="position-relative">
                                                <details
                                                    class="js-branch-select-menu details-reset details-overlay mr-0 mb-0 "
                                                    id="branch-select-menu"
                                                    data-hydro-click-payload="{&quot;event_type&quot;:&quot;repository.click&quot;,&quot;payload&quot;:{&quot;target&quot;:&quot;REFS_SELECTOR_MENU&quot;,&quot;repository_id&quot;:605534044,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="513dca9a00f4e7374145b6c9bdc649e5624aba898ad285fadba446ff6d595f0a">
                                                    <summary class="btn css-truncate"
                                                             data-hotkey="w"
                                                             title="Switch branches or tags">
                                                        <svg text="gray" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-git-branch">
                                                            <path d="M9.5 3.25a2.25 2.25 0 1 1 3 2.122V6A2.5 2.5 0 0 1 10 8.5H6a1 1 0 0 0-1 1v1.128a2.251 2.251 0 1 1-1.5 0V5.372a2.25 2.25 0 1 1 1.5 0v1.836A2.493 2.493 0 0 1 6 7h4a1 1 0 0 0 1-1v-.628A2.25 2.25 0 0 1 9.5 3.25Zm-6 0a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Zm8.25-.75a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM4.25 12a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Z"></path>
                                                        </svg>
                                                        <span class="css-truncate-target" data-menu-button>main</span>
                                                        <span class="dropdown-caret"></span>
                                                    </summary>


                                                    <div class="SelectMenu">
                                                        <div class="SelectMenu-modal">


                                                            <input-demux data-action="tab-container-change:input-demux#storeInput tab-container-changed:input-demux#updateInput">
                                                                <tab-container class="d-flex flex-column js-branches-tags-tabs" style="min-height: 0;">
                                                                    <div class="SelectMenu-filter">
                                                                        <input data-target="input-demux.source"
                                                                               id="context-commitish-filter-field"
                                                                               class="SelectMenu-input form-control"
                                                                               aria-owns="ref-list-branches"
                                                                               data-controls-ref-menu-id="ref-list-branches"
                                                                               autofocus
                                                                               autocomplete="off"
                                                                               aria-label="Filter branches/tags"
                                                                               placeholder="Filter branches/tags"
                                                                               type="text"
                                                                        >
                                                                    </div>

                                                                    <div class="SelectMenu-tabs" role="tablist" data-target="input-demux.control" >
                                                                        <button class="SelectMenu-tab" type="button" role="tab" aria-selected="true">Branches</button>
                                                                        <button class="SelectMenu-tab" type="button" role="tab">Tags</button>
                                                                    </div>

                                                                    <div role="tabpanel" id="ref-list-branches" data-filter-placeholder="Filter branches/tags" tabindex="" class="d-flex flex-column flex-auto overflow-auto">
                                                                        <ref-selector
                                                                            type="branch"
                                                                            data-targets="input-demux.sinks"
                                                                            data-action="
              input-entered:ref-selector#inputEntered
              tab-selected:ref-selector#tabSelected
              focus-list:ref-selector#focusFirstListMember
            "
                                                                            query-endpoint="/restinpc/DAO/refs"

                                                                            cache-key="v0:1677862785.663657"
                                                                            current-committish="bWFpbg=="
                                                                            default-branch="bWFpbg=="
                                                                            name-with-owner="cmVzdGlucGMvREFP"
                                                                            prefetch-on-mouseover
                                                                        >

                                                                            <template data-target="ref-selector.fetchFailedTemplate">
                                                                                <div class="SelectMenu-message" data-index="{{ index }}">Could not load branches</div>
                                                                            </template>

                                                                            <template data-target="ref-selector.noMatchTemplate">
                                                                                <div class="SelectMenu-message">Nothing to show</div>
                                                                            </template>


                                                                            <div data-target="ref-selector.listContainer" role="menu" class="SelectMenu-list " data-turbo-frame="repo-content-turbo-frame">
                                                                                <div class="SelectMenu-loading pt-3 pb-0 overflow-hidden" aria-label="Menu is loading">
                                                                                    <svg style="box-sizing: content-box; color: var(--color-icon-primary);" width="32" height="32" viewBox="0 0 16 16" fill="none" data-view-component="true" class="anim-rotate">
                                                                                        <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-opacity="0.25" stroke-width="2" vector-effect="non-scaling-stroke" />
                                                                                        <path d="M15 8a7.002 7.002 0 00-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" vector-effect="non-scaling-stroke" />
                                                                                    </svg>
                                                                                </div>
                                                                            </div>



                                                                            <template data-target="ref-selector.itemTemplate">
                                                                                <a href="https://github.com/restinpc/DAO/tree/{{ urlEncodedRefName }}" class="SelectMenu-item" role="menuitemradio" rel="nofollow" aria-checked="{{ isCurrent }}" data-index="{{ index }}" >
                                                                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check SelectMenu-icon SelectMenu-icon--check">
                                                                                        <path d="M13.78 4.22a.75.75 0 0 1 0 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L2.22 9.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018L6 10.94l6.72-6.72a.75.75 0 0 1 1.06 0Z"></path>
                                                                                    </svg>
                                                                                    <span class="flex-1 css-truncate css-truncate-overflow {{ isFilteringClass }}">{{ refName }}</span>
                                                                                    <span hidden="{{ isNotDefault }}" class="Label Label--secondary flex-self-start">default</span>
                                                                                </a>
                                                                            </template>


                                                                            <footer class="SelectMenu-footer"><a target="_blank" href="https://github.com/restinpc/DAO/branches">View all branches</a></footer>
                                                                        </ref-selector>

                                                                    </div>

                                                                    <div role="tabpanel" id="tags-menu" data-filter-placeholder="Find a tag" tabindex="" hidden class="d-flex flex-column flex-auto overflow-auto">
                                                                        <ref-selector
                                                                            type="tag"
                                                                            data-action="
              input-entered:ref-selector#inputEntered
              tab-selected:ref-selector#tabSelected
              focus-list:ref-selector#focusFirstListMember
            "
                                                                            data-targets="input-demux.sinks"
                                                                            query-endpoint="/restinpc/DAO/refs"
                                                                            cache-key="v0:1677862785.663657"
                                                                            current-committish="bWFpbg=="
                                                                            default-branch="bWFpbg=="
                                                                            name-with-owner="cmVzdGlucGMvREFP"
                                                                        >

                                                                            <template data-target="ref-selector.fetchFailedTemplate">
                                                                                <div class="SelectMenu-message" data-index="{{ index }}">Could not load tags</div>
                                                                            </template>

                                                                            <template data-target="ref-selector.noMatchTemplate">
                                                                                <div class="SelectMenu-message" data-index="{{ index }}">Nothing to show</div>
                                                                            </template>



                                                                            <template data-target="ref-selector.itemTemplate">
                                                                                <a href="https://github.com/restinpc/DAO/tree/{{ urlEncodedRefName }}" class="SelectMenu-item" role="menuitemradio" rel="nofollow" aria-checked="{{ isCurrent }}" data-index="{{ index }}" >
                                                                                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check SelectMenu-icon SelectMenu-icon--check">
                                                                                        <path d="M13.78 4.22a.75.75 0 0 1 0 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L2.22 9.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018L6 10.94l6.72-6.72a.75.75 0 0 1 1.06 0Z"></path>
                                                                                    </svg>
                                                                                    <span class="flex-1 css-truncate css-truncate-overflow {{ isFilteringClass }}">{{ refName }}</span>
                                                                                    <span hidden="{{ isNotDefault }}" class="Label Label--secondary flex-self-start">default</span>
                                                                                </a>
                                                                            </template>


                                                                            <div data-target="ref-selector.listContainer" role="menu" class="SelectMenu-list" data-turbo-frame="repo-content-turbo-frame">
                                                                                <div class="SelectMenu-loading pt-3 pb-0 overflow-hidden" aria-label="Menu is loading">
                                                                                    <svg style="box-sizing: content-box; color: var(--color-icon-primary);" width="32" height="32" viewBox="0 0 16 16" fill="none" data-view-component="true" class="anim-rotate">
                                                                                        <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-opacity="0.25" stroke-width="2" vector-effect="non-scaling-stroke" />
                                                                                        <path d="M15 8a7.002 7.002 0 00-7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" vector-effect="non-scaling-stroke" />
                                                                                    </svg>
                                                                                </div>
                                                                            </div>
                                                                            <footer class="SelectMenu-footer"><a target="_blank" href="https://github.com/restinpc/DAO/tags">View all tags</a></footer>
                                                                        </ref-selector>
                                                                    </div>
                                                                </tab-container>
                                                            </input-demux>
                                                        </div>
                                                    </div>

                                                </details>

                                            </div>


                                            <div class="Overlay--hidden Overlay-backdrop--center" data-modal-dialog-overlay>
                                                <modal-dialog role="dialog" id="warn-tag-match-create-branch-dialog" aria-modal="true" aria-labelledby="warn-tag-match-create-branch-dialog-header" data-view-component="true" class="Overlay Overlay--width-large Overlay--height-auto Overlay--motion-scaleFade">

                                                    <div class="Overlay-body ">

                                                        <div data-view-component="true">      A tag already exists with the provided branch name. Many Git commands accept both tag and branch names, so creating this branch may cause unexpected behavior. Are you sure you want to create this branch?
                                                        </div>

                                                    </div>
                                                    <footer class="Overlay-footer Overlay-footer--alignEnd">
                                                        <button data-close-dialog-id="warn-tag-match-create-branch-dialog" type="button" data-view-component="true" class="btn">    Cancel
                                                        </button>
                                                        <button data-submit-dialog-id="warn-tag-match-create-branch-dialog" type="button" data-view-component="true" class="btn-danger btn">    Create
                                                        </button>
                                                    </footer>
                                                </modal-dialog></div>



                                            <div class="flex-self-center flex-self-stretch d-none flex-items-center lh-condensed-ultra d-lg-flex">
                                                <a data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/branches" class="ml-3 Link--primary no-underline">
                                                    <svg text="gray" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-git-branch">
                                                        <path d="M9.5 3.25a2.25 2.25 0 1 1 3 2.122V6A2.5 2.5 0 0 1 10 8.5H6a1 1 0 0 0-1 1v1.128a2.251 2.251 0 1 1-1.5 0V5.372a2.25 2.25 0 1 1 1.5 0v1.836A2.493 2.493 0 0 1 6 7h4a1 1 0 0 0 1-1v-.628A2.25 2.25 0 0 1 9.5 3.25Zm-6 0a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Zm8.25-.75a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM4.25 12a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Z"></path>
                                                    </svg>
                                                    <strong>2</strong>
                                                    <span class="color-fg-muted">branches</span>
                                                </a>
                                                <a data-pjax="#repo-content-pjax-container" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/tags" class="ml-3 Link--primary no-underline">
                                                    <svg text="gray" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-tag">
                                                        <path d="M1 7.775V2.75C1 1.784 1.784 1 2.75 1h5.025c.464 0 .91.184 1.238.513l6.25 6.25a1.75 1.75 0 0 1 0 2.474l-5.026 5.026a1.75 1.75 0 0 1-2.474 0l-6.25-6.25A1.752 1.752 0 0 1 1 7.775Zm1.5 0c0 .066.026.13.073.177l6.25 6.25a.25.25 0 0 0 .354 0l5.025-5.025a.25.25 0 0 0 0-.354l-6.25-6.25a.25.25 0 0 0-.177-.073H2.75a.25.25 0 0 0-.25.25ZM6 5a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z"></path>
                                                    </svg>
                                                    <strong>0</strong>
                                                    <span class="color-fg-muted">tags</span>
                                                </a>
                                            </div>

                                            <div class="flex-auto"></div>

                                            <include-fragment ></include-fragment>


                                            <span class="d-none d-md-flex ml-2">

<get-repo class="">

    <details class="position-relative details-overlay details-reset js-codespaces-details-container"
             data-action="
               toggle:get-repo#onDetailsToggle
               keydown:get-repo#onDetailsKeydown"

    >
        <summary data-hydro-click="{&quot;event_type&quot;:&quot;repository.click&quot;,&quot;payload&quot;:{&quot;repository_id&quot;:605534044,&quot;target&quot;:&quot;CLONE_OR_DOWNLOAD_BUTTON&quot;,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="b7d4c5ae4faf8abc154eac6fd17f3f40e2e7f9430bc81d0129ce1cd814badb3c" data-view-component="true" class="Button--primary Button--medium Button flex-1 d-inline-flex">    <span class="Button-content">
      <span class="Button-label">Code</span>
    </span>
      <span class="Button-visual Button-trailingAction">
        <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-triangle-down">
    <path d="m4.427 7.427 3.396 3.396a.25.25 0 0 0 .354 0l3.396-3.396A.25.25 0 0 0 11.396 7H4.604a.25.25 0 0 0-.177.427Z"></path>
</svg>
      </span>
</summary>
      <div class="position-relative">
        <div class="dropdown-menu dropdown-menu-sw p-0" style="top:6px;width:400px;max-width: calc(100vw - 320px);">
          <div
              data-target="get-repo.modal"

          >
    <tab-container data-view-component="true">
  <div with_panel="true" data-view-component="true" class="tabnav hx_tabnav-in-dropdown color-bg-subtle m-0">

    <ul role="tablist" aria-label="Choose where to access your code" data-view-component="true" class="tabnav-tabs d-flex">
        <li role="presentation" data-view-component="true" class="hx_tabnav-in-dropdown-wrapper flex-1 d-inline-flex">
  <button data-tab="local" data-action="click:get-repo#localTabSelected focusin:get-repo#localTabSelected" id="local-tab" type="button" role="tab" aria-controls="local-panel" aria-selected="true" data-view-component="true" class="tabnav-tab flex-1">

      <span data-view-component="true">Local</span>

</button></li>
        <li role="presentation" data-view-component="true" class="hx_tabnav-in-dropdown-wrapper flex-1 d-inline-flex">
  <button data-tab="cloud" data-action="click:get-repo#cloudTabSelected focusin:get-repo#cloudTabSelected" data-target="feature-callout.dismisser" id="cloud-tab" type="button" role="tab" aria-controls="cloud-panel" data-view-component="true" class="tabnav-tab flex-1">

      <span data-view-component="true">          <span>Codespaces</span>
</span>

</button></li>
</ul>
</div>    <div id="local-panel" role="tabpanel" tabindex="0" aria-labelledby="local-tab" data-view-component="true">          <ul class="list-style-none">
              <li class="Box-row p-3">
  <a class="Link--muted float-right tooltipped tooltipped-s" href="https://docs.github.com/articles/which-remote-url-should-i-use" target="_blank" aria-label="Which remote URL should I use?">
  <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-question">
    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm8-6.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13ZM6.92 6.085h.001a.749.749 0 1 1-1.342-.67c.169-.339.436-.701.849-.977C6.845 4.16 7.369 4 8 4a2.756 2.756 0 0 1 1.637.525c.503.377.863.965.863 1.725 0 .448-.115.83-.329 1.15-.205.307-.47.513-.692.662-.109.072-.22.138-.313.195l-.006.004a6.24 6.24 0 0 0-.26.16.952.952 0 0 0-.276.245.75.75 0 0 1-1.248-.832c.184-.264.42-.489.692-.661.103-.067.207-.132.313-.195l.007-.004c.1-.061.182-.11.258-.161a.969.969 0 0 0 .277-.245C8.96 6.514 9 6.427 9 6.25a.612.612 0 0 0-.262-.525A1.27 1.27 0 0 0 8 5.5c-.369 0-.595.09-.74.187a1.01 1.01 0 0 0-.34.398ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
</svg>
</a>

<div class="text-bold">
  <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-terminal mr-2">
    <path d="M0 2.75C0 1.784.784 1 1.75 1h12.5c.966 0 1.75.784 1.75 1.75v10.5A1.75 1.75 0 0 1 14.25 15H1.75A1.75 1.75 0 0 1 0 13.25Zm1.75-.25a.25.25 0 0 0-.25.25v10.5c0 .138.112.25.25.25h12.5a.25.25 0 0 0 .25-.25V2.75a.25.25 0 0 0-.25-.25ZM7.25 8a.749.749 0 0 1-.22.53l-2.25 2.25a.749.749 0 0 1-1.275-.326.749.749 0 0 1 .215-.734L5.44 8 3.72 6.28a.749.749 0 0 1 .326-1.275.749.749 0 0 1 .734.215l2.25 2.25c.141.14.22.331.22.53Zm1.5 1.5h3a.75.75 0 0 1 0 1.5h-3a.75.75 0 0 1 0-1.5Z"></path>
</svg>
  Clone
</div>

<tab-container>

  <div class="UnderlineNav my-2 box-shadow-none">
    <div class="UnderlineNav-body" role="tablist">
          <button name="button" type="button" role="tab" class="UnderlineNav-item" aria-selected="true" data-hydro-click="{&quot;event_type&quot;:&quot;clone_or_download.click&quot;,&quot;payload&quot;:{&quot;feature_clicked&quot;:&quot;USE_HTTPS&quot;,&quot;git_repository_type&quot;:&quot;REPOSITORY&quot;,&quot;repository_id&quot;:605534044,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="cacfe50b0595939dbaab4d042f03ce0b4cc03d8b6ec75d095bf672c77f674795">
            HTTPS
</button>          <button name="button" type="button" role="tab" class="UnderlineNav-item" data-hydro-click="{&quot;event_type&quot;:&quot;clone_or_download.click&quot;,&quot;payload&quot;:{&quot;feature_clicked&quot;:&quot;USE_GH_CLI&quot;,&quot;git_repository_type&quot;:&quot;REPOSITORY&quot;,&quot;repository_id&quot;:605534044,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="550f9abf78089da93d8f21959c7fd501fe344d2e1c8bc6ba7b7a269bee0be84e">
            GitHub CLI
</button>    </div>
  </div>

  <div role="tabpanel">
    <div class="input-group">
  <input type="text" class="form-control input-monospace input-sm color-bg-subtle" data-autoselect value="https://github.com/restinpc/DAO.git" aria-label="https://github.com/restinpc/DAO.git" readonly>
  <div class="input-group-button">
    <clipboard-copy value="https://github.com/restinpc/DAO.git" aria-label="Copy to clipboard" class="btn btn-sm js-clipboard-copy tooltipped-no-delay ClipboardButton js-clone-url-http" data-copy-feedback="Copied!" data-tooltip-direction="n" data-hydro-click="{&quot;event_type&quot;:&quot;clone_or_download.click&quot;,&quot;payload&quot;:{&quot;feature_clicked&quot;:&quot;COPY_URL&quot;,&quot;git_repository_type&quot;:&quot;REPOSITORY&quot;,&quot;repository_id&quot;:605534044,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="2aefa0d72ec22c7b34009d40f9b21f106a73fe7497ac2007694698a260034e6b"><svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-copy js-clipboard-copy-icon d-inline-block">
    <path d="M0 6.75C0 5.784.784 5 1.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-1.5a.75.75 0 0 1 1.5 0v1.5A1.75 1.75 0 0 1 9.25 16h-7.5A1.75 1.75 0 0 1 0 14.25Z"></path><path d="M5 1.75C5 .784 5.784 0 6.75 0h7.5C15.216 0 16 .784 16 1.75v7.5A1.75 1.75 0 0 1 14.25 11h-7.5A1.75 1.75 0 0 1 5 9.25Zm1.75-.25a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25Z"></path>
</svg><svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check js-clipboard-check-icon color-fg-success d-inline-block d-sm-none">
    <path d="M13.78 4.22a.75.75 0 0 1 0 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L2.22 9.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018L6 10.94l6.72-6.72a.75.75 0 0 1 1.06 0Z"></path>
</svg></clipboard-copy>
  </div>
</div>

    <p class="mt-2 mb-0 f6 color-fg-muted">
        Use Git or checkout with SVN using the web URL.
    </p>
  </div>


  <div role="tabpanel" hidden>
    <div class="input-group">
  <input type="text" class="form-control input-monospace input-sm color-bg-subtle" data-autoselect value="gh repo clone restinpc/DAO" aria-label="gh repo clone restinpc/DAO" readonly>
  <div class="input-group-button">
    <clipboard-copy value="gh repo clone restinpc/DAO" aria-label="Copy to clipboard" class="btn btn-sm js-clipboard-copy tooltipped-no-delay ClipboardButton js-clone-url-gh-cli" data-copy-feedback="Copied!" data-tooltip-direction="n" data-hydro-click="{&quot;event_type&quot;:&quot;clone_or_download.click&quot;,&quot;payload&quot;:{&quot;feature_clicked&quot;:&quot;COPY_URL&quot;,&quot;git_repository_type&quot;:&quot;REPOSITORY&quot;,&quot;repository_id&quot;:605534044,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="2aefa0d72ec22c7b34009d40f9b21f106a73fe7497ac2007694698a260034e6b"><svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-copy js-clipboard-copy-icon d-inline-block">
    <path d="M0 6.75C0 5.784.784 5 1.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-1.5a.75.75 0 0 1 1.5 0v1.5A1.75 1.75 0 0 1 9.25 16h-7.5A1.75 1.75 0 0 1 0 14.25Z"></path><path d="M5 1.75C5 .784 5.784 0 6.75 0h7.5C15.216 0 16 .784 16 1.75v7.5A1.75 1.75 0 0 1 14.25 11h-7.5A1.75 1.75 0 0 1 5 9.25Zm1.75-.25a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25Z"></path>
</svg><svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check js-clipboard-check-icon color-fg-success d-inline-block d-sm-none">
    <path d="M13.78 4.22a.75.75 0 0 1 0 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L2.22 9.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018L6 10.94l6.72-6.72a.75.75 0 0 1 1.06 0Z"></path>
</svg></clipboard-copy>
  </div>
</div>

    <p class="mt-2 mb-0 f6 color-fg-muted">
      Work fast with our official CLI.
      <a href="https://cli.github.com" target="_blank">Learn more about the CLI</a>.
    </p>
  </div>
</tab-container>

</li>
<li data-platforms="windows,mac" class="Box-row Box-row--hover-gray p-3 mt-0 rounded-0 js-remove-unless-platform">
  <a class="d-flex flex-items-center color-fg-default text-bold no-underline" data-hydro-click="{&quot;event_type&quot;:&quot;clone_or_download.click&quot;,&quot;payload&quot;:{&quot;feature_clicked&quot;:&quot;OPEN_IN_DESKTOP&quot;,&quot;git_repository_type&quot;:&quot;REPOSITORY&quot;,&quot;repository_id&quot;:605534044,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="9d85716fa1129525df5ea2fb0d44fb4d4d0b1934fbf5ede8152b7c8827408cac" data-action="click:get-repo#showDownloadMessage" href="https://desktop.github.com">
    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-desktop-download mr-2">
    <path d="m4.927 5.427 2.896 2.896a.25.25 0 0 0 .354 0l2.896-2.896A.25.25 0 0 0 10.896 5H8.75V.75a.75.75 0 1 0-1.5 0V5H5.104a.25.25 0 0 0-.177.427Z"></path><path d="M1.573 2.573a.25.25 0 0 0-.073.177v7.5a.25.25 0 0 0 .25.25h12.5a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25h-3a.75.75 0 1 1 0-1.5h3A1.75 1.75 0 0 1 16 2.75v7.5A1.75 1.75 0 0 1 14.25 12h-3.727c.099 1.041.52 1.872 1.292 2.757A.75.75 0 0 1 11.25 16h-6.5a.75.75 0 0 1-.565-1.243c.772-.885 1.192-1.716 1.292-2.757H1.75A1.75 1.75 0 0 1 0 10.25v-7.5A1.75 1.75 0 0 1 1.75 1h3a.75.75 0 0 1 0 1.5h-3a.25.25 0 0 0-.177.073ZM6.982 12a5.72 5.72 0 0 1-.765 2.5h3.566a5.72 5.72 0 0 1-.765-2.5H6.982Z"></path>
</svg>
    Open with GitHub Desktop
</a></li>
<li class="Box-row Box-row--hover-gray p-3 mt-0" >
  <a class="d-flex flex-items-center color-fg-default text-bold no-underline" rel="nofollow" data-hydro-click="{&quot;event_type&quot;:&quot;clone_or_download.click&quot;,&quot;payload&quot;:{&quot;feature_clicked&quot;:&quot;DOWNLOAD_ZIP&quot;,&quot;git_repository_type&quot;:&quot;REPOSITORY&quot;,&quot;repository_id&quot;:605534044,&quot;originating_url&quot;:&quot;https://github.com/restinpc/DAO&quot;,&quot;user_id&quot;:null}}" data-hydro-click-hmac="22735c8b0b64ca1eba0ffd6b2a7dae54adbfbcd0cd9706019d5e99443d6d4cd4" data-ga-click="Repository, download zip, location:repo overview" data-open-app="link" data-turbo="false" target="_blank" href="https://github.com/restinpc/DAO/archive/refs/heads/main.zip">
    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-file-zip mr-2">
    <path d="M3.5 1.75v11.5c0 .09.048.173.126.217a.75.75 0 0 1-.752 1.298A1.748 1.748 0 0 1 2 13.25V1.75C2 .784 2.784 0 3.75 0h5.586c.464 0 .909.185 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v8.586A1.75 1.75 0 0 1 12.25 15h-.5a.75.75 0 0 1 0-1.5h.5a.25.25 0 0 0 .25-.25V4.664a.25.25 0 0 0-.073-.177L9.513 1.573a.25.25 0 0 0-.177-.073H7.25a.75.75 0 0 1 0 1.5h-.5a.75.75 0 0 1 0-1.5h-3a.25.25 0 0 0-.25.25Zm3.75 8.75h.5c.966 0 1.75.784 1.75 1.75v3a.75.75 0 0 1-.75.75h-2.5a.75.75 0 0 1-.75-.75v-3c0-.966.784-1.75 1.75-1.75ZM6 5.25a.75.75 0 0 1 .75-.75h.5a.75.75 0 0 1 0 1.5h-.5A.75.75 0 0 1 6 5.25Zm.75 2.25h.5a.75.75 0 0 1 0 1.5h-.5a.75.75 0 0 1 0-1.5ZM8 6.75A.75.75 0 0 1 8.75 6h.5a.75.75 0 0 1 0 1.5h-.5A.75.75 0 0 1 8 6.75ZM8.75 3h.5a.75.75 0 0 1 0 1.5h-.5a.75.75 0 0 1 0-1.5ZM8 9.75A.75.75 0 0 1 8.75 9h.5a.75.75 0 0 1 0 1.5h-.5A.75.75 0 0 1 8 9.75Zm-1 2.5v2.25h1v-2.25a.25.25 0 0 0-.25-.25h-.5a.25.25 0 0 0-.25.25Z"></path>
</svg>
    Download ZIP
</a></li>

          </ul>
</div>
    <div id="cloud-panel" role="tabpanel" tabindex="0" hidden="hidden" aria-labelledby="cloud-tab" data-view-component="true" class="cloud-panel">            <div data-view-component="true" class="blankslate">
    <h4 data-view-component="true" class="mb-1">Sign In Required</h4>

              <p class="mt-2 mx-4">
                Please
                <a target="_blank" href="https://github.com/codespaces/new?hide_repo_select=true&amp;ref=main&amp;repo=605534044" data-view-component="true" class="no-underline">sign in</a>
                to use Codespaces.
              </p>

</div></div>
</tab-container></div>


<div class="p-3" data-targets="get-repo.platforms" data-platform="mac" hidden>
  <h4 class="lh-condensed mb-3">Launching GitHub Desktop<span class="AnimatedEllipsis"></span></h4>
  <p class="color-fg-muted">
    If nothing happens, <a href="https://desktop.github.com/">download GitHub Desktop</a> and try again.
  </p>
    <button data-action="click:get-repo#onDetailsToggle" type="button" data-view-component="true" class="btn-link">
</button>
</div>
<div class="p-3" data-targets="get-repo.platforms" data-platform="windows" hidden>
  <h4 class="lh-condensed mb-3">Launching GitHub Desktop<span class="AnimatedEllipsis"></span></h4>
  <p class="color-fg-muted">
    If nothing happens, <a href="https://desktop.github.com/">download GitHub Desktop</a> and try again.
  </p>
    <button data-action="click:get-repo#onDetailsToggle" type="button" data-view-component="true" class="btn-link">
</button>
</div>
<div class="p-3" data-targets="get-repo.platforms" data-platform="xcode" hidden>
  <h4 class="lh-condensed mb-3">Launching Xcode<span class="AnimatedEllipsis"></span></h4>
  <p class="color-fg-muted">
    If nothing happens, <a href="https://developer.apple.com/xcode/">download Xcode</a> and try again.
  </p>
    <button data-action="click:get-repo#onDetailsToggle" type="button" data-view-component="true" class="btn-link">
</button>
</div>
<div class="p-3 " data-targets="get-repo.platforms" data-target="new-codespace.loadingVscode create-button.loadingVscode" data-platform="vscode" hidden>
  <poll-include-fragment data-target="get-repo.vscodePoller new-codespace.vscodePoller create-button.vscodePoller">
    <h4 class="lh-condensed mb-3">Launching Visual Studio Code<span class="AnimatedEllipsis" data-hide-on-error></span></h4>
    <p class="color-fg-muted" data-hide-on-error>Your codespace will open once ready.</p>
    <p class="color-fg-muted" data-show-on-error hidden>There was a problem preparing your codespace, please try again.</p>
  </poll-include-fragment>
</div>


        </div>
      </div>
    </details>


</get-repo>

    </span>

                                            <span class="d-none d-lg-flex">


    </span>
                                        </div>







                                        <div class="Box mb-3" >

                                            <h2 id="files"  class="sr-only">Files</h2>



                                            <include-fragment>
                                                <a class="d-none js-permalink-shortcut" data-hotkey="y" target="_blank" href="https://github.com/restinpc/DAO/tree/7caf13af428a0fd0f921bc7afdf32e069f9f2cea">Permalink</a>

                                                <div class="js-details-container Details" data-hpc>
                                                    <div role="grid" aria-labelledby="files" class="Details-content--hidden-not-important js-navigation-container js-active-navigation-container d-md-block">
                                                        <div class="sr-only" role="row">
                                                            <div role="columnheader">Type</div>
                                                            <div role="columnheader">Name</div>
                                                            <div role="columnheader" class="d-none d-md-block">Latest commit message</div>
                                                            <div role="columnheader">Commit time</div>
                                                        </div>

                                                        <div role="row" class="Box-row Box-row--focus-gray py-2 d-flex position-relative js-navigation-item ">
                                                            <div role="gridcell" class="mr-3 flex-shrink-0" style="width: 16px;">
                                                                <svg aria-label="Directory" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-file-directory-fill hx_color-icon-directory">
                                                                    <path d="M1.75 1A1.75 1.75 0 0 0 0 2.75v10.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0 0 16 13.25v-8.5A1.75 1.75 0 0 0 14.25 3H7.5a.25.25 0 0 1-.2-.1l-.9-1.2C6.07 1.26 5.55 1 5 1H1.75Z"></path>
                                                                </svg>
                                                            </div>

                                                            <div role="rowheader" class="flex-auto min-width-0 col-md-2 mr-3">
                                                                <span class="css-truncate css-truncate-target d-block width-fit"><a class="js-navigation-open Link--primary" title="2D" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/tree/main/2D">2D</a></span>
                                                            </div>

                                                            <div role="gridcell" class="flex-auto min-width-0 d-none d-md-block col-5 mr-3" >
                                                                <div class="Skeleton Skeleton--text col-7">&nbsp;</div>
                                                            </div>

                                                            <div role="gridcell" class="color-fg-muted text-right" style="width:100px;">
                                                                <div class="Skeleton Skeleton--text">&nbsp;</div>
                                                            </div>

                                                        </div>
                                                        <div role="row" class="Box-row Box-row--focus-gray py-2 d-flex position-relative js-navigation-item ">
                                                            <div role="gridcell" class="mr-3 flex-shrink-0" style="width: 16px;">
                                                                <svg aria-label="Directory" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-file-directory-fill hx_color-icon-directory">
                                                                    <path d="M1.75 1A1.75 1.75 0 0 0 0 2.75v10.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0 0 16 13.25v-8.5A1.75 1.75 0 0 0 14.25 3H7.5a.25.25 0 0 1-.2-.1l-.9-1.2C6.07 1.26 5.55 1 5 1H1.75Z"></path>
                                                                </svg>
                                                            </div>

                                                            <div role="rowheader" class="flex-auto min-width-0 col-md-2 mr-3">
                                                                <span class="css-truncate css-truncate-target d-block width-fit"><a class="js-navigation-open Link--primary" title="3D" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/tree/main/3D">3D</a></span>
                                                            </div>

                                                            <div role="gridcell" class="flex-auto min-width-0 d-none d-md-block col-5 mr-3" >
                                                                <div class="Skeleton Skeleton--text col-7">&nbsp;</div>
                                                            </div>

                                                            <div role="gridcell" class="color-fg-muted text-right" style="width:100px;">
                                                                <div class="Skeleton Skeleton--text">&nbsp;</div>
                                                            </div>

                                                        </div>

                                                        <div role="row" class="Box-row Box-row--focus-gray py-2 d-flex position-relative js-navigation-item ">
                                                            <div role="gridcell" class="mr-3 flex-shrink-0" style="width: 16px;">
                                                                <svg aria-label="Directory" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-file-directory-fill hx_color-icon-directory">
                                                                    <path d="M1.75 1A1.75 1.75 0 0 0 0 2.75v10.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0 0 16 13.25v-8.5A1.75 1.75 0 0 0 14.25 3H7.5a.25.25 0 0 1-.2-.1l-.9-1.2C6.07 1.26 5.55 1 5 1H1.75Z"></path>
                                                                </svg>
                                                            </div>

                                                            <div role="rowheader" class="flex-auto min-width-0 col-md-2 mr-3">
                                                                <span class="css-truncate css-truncate-target d-block width-fit"><a class="js-navigation-open Link--primary" title="Social" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/tree/main/Social">Social</a></span>
                                                            </div>

                                                            <div role="gridcell" class="flex-auto min-width-0 d-none d-md-block col-5 mr-3" >
                                                                <div class="Skeleton Skeleton--text col-7">&nbsp;</div>
                                                            </div>

                                                            <div role="gridcell" class="color-fg-muted text-right" style="width:100px;">
                                                                <div class="Skeleton Skeleton--text">&nbsp;</div>
                                                            </div>

                                                        </div>
                                                        <div role="row" class="Box-row Box-row--focus-gray py-2 d-flex position-relative js-navigation-item ">
                                                            <div role="gridcell" class="mr-3 flex-shrink-0" style="width: 16px;">
                                                                <svg aria-label="Directory" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-file-directory-fill hx_color-icon-directory">
                                                                    <path d="M1.75 1A1.75 1.75 0 0 0 0 2.75v10.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0 0 16 13.25v-8.5A1.75 1.75 0 0 0 14.25 3H7.5a.25.25 0 0 1-.2-.1l-.9-1.2C6.07 1.26 5.55 1 5 1H1.75Z"></path>
                                                                </svg>
                                                            </div>

                                                            <div role="rowheader" class="flex-auto min-width-0 col-md-2 mr-3">
                                                                <span class="css-truncate css-truncate-target d-block width-fit"><a class="js-navigation-open Link--primary" title="VR" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/tree/main/VR">VR</a></span>
                                                            </div>

                                                            <div role="gridcell" class="flex-auto min-width-0 d-none d-md-block col-5 mr-3" >
                                                                <div class="Skeleton Skeleton--text col-7">&nbsp;</div>
                                                            </div>

                                                            <div role="gridcell" class="color-fg-muted text-right" style="width:100px;">
                                                                <div class="Skeleton Skeleton--text">&nbsp;</div>
                                                            </div>

                                                        </div>
                                                        <div role="row" class="Box-row Box-row--focus-gray py-2 d-flex position-relative js-navigation-item ">
                                                            <div role="gridcell" class="mr-3 flex-shrink-0" style="width: 16px;">
                                                                <svg aria-label="File" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-file color-fg-muted">
                                                                    <path d="M2 1.75C2 .784 2.784 0 3.75 0h6.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v9.586A1.75 1.75 0 0 1 13.25 16h-9.5A1.75 1.75 0 0 1 2 14.25Zm1.75-.25a.25.25 0 0 0-.25.25v12.5c0 .138.112.25.25.25h9.5a.25.25 0 0 0 .25-.25V6h-2.75A1.75 1.75 0 0 1 9 4.25V1.5Zm6.75.062V4.25c0 .138.112.25.25.25h2.688l-.011-.013-2.914-2.914-.013-.011Z"></path>
                                                                </svg>
                                                            </div>

                                                            <div role="rowheader" class="flex-auto min-width-0 col-md-2 mr-3">
                                                                <span class="css-truncate css-truncate-target d-block width-fit"><a class="js-navigation-open Link--primary" title=".DS_Store" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/blob/main/.DS_Store">.DS_Store</a></span>
                                                            </div>

                                                            <div role="gridcell" class="flex-auto min-width-0 d-none d-md-block col-5 mr-3" >
                                                                <div class="Skeleton Skeleton--text col-7">&nbsp;</div>
                                                            </div>

                                                            <div role="gridcell" class="color-fg-muted text-right" style="width:100px;">
                                                                <div class="Skeleton Skeleton--text">&nbsp;</div>
                                                            </div>

                                                        </div>
                                                        <div role="row" class="Box-row Box-row--focus-gray py-2 d-flex position-relative js-navigation-item ">
                                                            <div role="gridcell" class="mr-3 flex-shrink-0" style="width: 16px;">
                                                                <svg aria-label="File" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-file color-fg-muted">
                                                                    <path d="M2 1.75C2 .784 2.784 0 3.75 0h6.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v9.586A1.75 1.75 0 0 1 13.25 16h-9.5A1.75 1.75 0 0 1 2 14.25Zm1.75-.25a.25.25 0 0 0-.25.25v12.5c0 .138.112.25.25.25h9.5a.25.25 0 0 0 .25-.25V6h-2.75A1.75 1.75 0 0 1 9 4.25V1.5Zm6.75.062V4.25c0 .138.112.25.25.25h2.688l-.011-.013-2.914-2.914-.013-.011Z"></path>
                                                                </svg>
                                                            </div>

                                                            <div role="rowheader" class="flex-auto min-width-0 col-md-2 mr-3">
                                                                <span class="css-truncate css-truncate-target d-block width-fit"><a class="js-navigation-open Link--primary" title=".gitignore" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/blob/main/.gitignore">.gitignore</a></span>
                                                            </div>

                                                            <div role="gridcell" class="flex-auto min-width-0 d-none d-md-block col-5 mr-3" >
                                                                <div class="Skeleton Skeleton--text col-7">&nbsp;</div>
                                                            </div>

                                                            <div role="gridcell" class="color-fg-muted text-right" style="width:100px;">
                                                                <div class="Skeleton Skeleton--text">&nbsp;</div>
                                                            </div>

                                                        </div>
                                                        <div role="row" class="Box-row Box-row--focus-gray py-2 d-flex position-relative js-navigation-item ">
                                                            <div role="gridcell" class="mr-3 flex-shrink-0" style="width: 16px;">
                                                                <svg aria-label="File" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-file color-fg-muted">
                                                                    <path d="M2 1.75C2 .784 2.784 0 3.75 0h6.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v9.586A1.75 1.75 0 0 1 13.25 16h-9.5A1.75 1.75 0 0 1 2 14.25Zm1.75-.25a.25.25 0 0 0-.25.25v12.5c0 .138.112.25.25.25h9.5a.25.25 0 0 0 .25-.25V6h-2.75A1.75 1.75 0 0 1 9 4.25V1.5Zm6.75.062V4.25c0 .138.112.25.25.25h2.688l-.011-.013-2.914-2.914-.013-.011Z"></path>
                                                                </svg>
                                                            </div>

                                                            <div role="rowheader" class="flex-auto min-width-0 col-md-2 mr-3">
                                                                <span class="css-truncate css-truncate-target d-block width-fit"><a class="js-navigation-open Link--primary" title="Readme.md" data-turbo-frame="repo-content-turbo-frame" target="_blank" href="https://github.com/restinpc/DAO/blob/main/Readme.md">Readme.md</a></span>
                                                            </div>

                                                            <div role="gridcell" class="flex-auto min-width-0 d-none d-md-block col-5 mr-3" >
                                                                <div class="Skeleton Skeleton--text col-7">&nbsp;</div>
                                                            </div>

                                                            <div role="gridcell" class="color-fg-muted text-right" style="width:100px;">
                                                                <div class="Skeleton Skeleton--text">&nbsp;</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="Details-content--shown Box-footer d-md-none p-0">
                                                        <button aria-expanded="false" type="button" data-view-component="true" class="js-details-target btn-link d-block width-full px-3 py-2">    View code
                                                        </button>    </div>
                                                </div>

                                            </include-fragment>


                                        </div>


                                    </div>
                                    <div data-view-component="true" class="Layout-sidebar">

                                        <div class="BorderGrid BorderGrid--spacious" data-pjax>
                                            <div class="BorderGrid-row hide-sm hide-md">
                                                <div class="BorderGrid-cell">
                                                    <h2 class="mb-3 h4">About</h2>

                                                    <div class="f4 my-3 color-fg-muted text-italic">
                                                        No description, website, or topics provided.
                                                    </div>


                                                    <h3 class="sr-only">Resources</h3>
                                                    <div class="mt-2">
                                                        <a class="Link--muted" data-analytics-event="{&quot;category&quot;:&quot;Repository Overview&quot;,&quot;action&quot;:&quot;click&quot;,&quot;label&quot;:&quot;location:sidebar;file:readme&quot;}" href="#readme">
                                                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-book mr-2">
                                                                <path d="M0 1.75A.75.75 0 0 1 .75 1h4.253c1.227 0 2.317.59 3 1.501A3.743 3.743 0 0 1 11.006 1h4.245a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-.75.75h-4.507a2.25 2.25 0 0 0-1.591.659l-.622.621a.75.75 0 0 1-1.06 0l-.622-.621A2.25 2.25 0 0 0 5.258 13H.75a.75.75 0 0 1-.75-.75Zm7.251 10.324.004-5.073-.002-2.253A2.25 2.25 0 0 0 5.003 2.5H1.5v9h3.757a3.75 3.75 0 0 1 1.994.574ZM8.755 4.75l-.004 7.322a3.752 3.752 0 0 1 1.992-.572H14.5v-9h-3.495a2.25 2.25 0 0 0-2.25 2.25Z"></path>
                                                            </svg>
                                                            Readme
                                                        </a>    </div>





                                                    <include-fragment >
                                                    </include-fragment>



                                                    <h3 class="sr-only">Stars</h3>
                                                    <div class="mt-2">
                                                        <a target="_blank" href="https://github.com/restinpc/DAO/stargazers" data-view-component="true" class="Link--muted">
                                                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-star mr-2">
                                                                <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Zm0 2.445L6.615 5.5a.75.75 0 0 1-.564.41l-3.097.45 2.24 2.184a.75.75 0 0 1 .216.664l-.528 3.084 2.769-1.456a.75.75 0 0 1 .698 0l2.77 1.456-.53-3.084a.75.75 0 0 1 .216-.664l2.24-2.183-3.096-.45a.75.75 0 0 1-.564-.41L8 2.694Z"></path>
                                                            </svg>
                                                            <strong>0</strong>
                                                            stars
                                                        </a></div>

                                                    <h3 class="sr-only">Watchers</h3>
                                                    <div class="mt-2">
                                                        <a target="_blank" href="https://github.com/restinpc/DAO/watchers" data-view-component="true" class="Link--muted">
                                                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-eye mr-2">
                                                                <path d="M8 2c1.981 0 3.671.992 4.933 2.078 1.27 1.091 2.187 2.345 2.637 3.023a1.62 1.62 0 0 1 0 1.798c-.45.678-1.367 1.932-2.637 3.023C11.67 13.008 9.981 14 8 14c-1.981 0-3.671-.992-4.933-2.078C1.797 10.83.88 9.576.43 8.898a1.62 1.62 0 0 1 0-1.798c.45-.677 1.367-1.931 2.637-3.022C4.33 2.992 6.019 2 8 2ZM1.679 7.932a.12.12 0 0 0 0 .136c.411.622 1.241 1.75 2.366 2.717C5.176 11.758 6.527 12.5 8 12.5c1.473 0 2.825-.742 3.955-1.715 1.124-.967 1.954-2.096 2.366-2.717a.12.12 0 0 0 0-.136c-.412-.621-1.242-1.75-2.366-2.717C10.824 4.242 9.473 3.5 8 3.5c-1.473 0-2.825.742-3.955 1.715-1.124.967-1.954 2.096-2.366 2.717ZM8 10a2 2 0 1 1-.001-3.999A2 2 0 0 1 8 10Z"></path>
                                                            </svg>
                                                            <strong>1</strong>
                                                            watching
                                                        </a></div>

                                                    <h3 class="sr-only">Forks</h3>
                                                    <div class="mt-2">
                                                        <a target="_blank" href="https://github.com/restinpc/DAO/forks" data-view-component="true" class="Link--muted">
                                                            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-repo-forked mr-2">
                                                                <path d="M5 5.372v.878c0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75v-.878a2.25 2.25 0 1 1 1.5 0v.878a2.25 2.25 0 0 1-2.25 2.25h-1.5v2.128a2.251 2.251 0 1 1-1.5 0V8.5h-1.5A2.25 2.25 0 0 1 3.5 6.25v-.878a2.25 2.25 0 1 1 1.5 0ZM5 3.25a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Zm6.75.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm-3 8.75a.75.75 0 1 0-1.5 0 .75.75 0 0 0 1.5 0Z"></path>
                                                            </svg>
                                                            <strong>1</strong>
                                                            fork
                                                        </a></div>

                                                    <div class="mt-2">
                                                        <a class="Link--muted" target="_blank" href="https://github.com/contact/report-content?content_url=https%3A%2F%2Fgithub.com%2Frestinpc%2FDAO&amp;report=restinpc+%28user%29">
                                                            Report repository
                                                        </a>  </div>

                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                </div></div>

                        </div>


                    </div>

                </turbo-frame>


            </main>
        </div>

    </div>

    <div id="ajax-error-message" class="ajax-error-message flash flash-error" hidden>
        <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-alert">
            <path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path>
        </svg>
        <button type="button" class="flash-close js-ajax-error-dismiss" aria-label="Dismiss error">
            <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-x">
                <path d="M3.72 3.72a.75.75 0 0 1 1.06 0L8 6.94l3.22-3.22a.749.749 0 0 1 1.275.326.749.749 0 0 1-.215.734L9.06 8l3.22 3.22a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215L8 9.06l-3.22 3.22a.751.751 0 0 1-1.042-.018.751.751 0 0 1-.018-1.042L6.94 8 3.72 4.78a.75.75 0 0 1 0-1.06Z"></path>
            </svg>
        </button>
        You can’t perform that action at this time.
    </div>

    <template id="site-details-dialog">
        <details class="details-reset details-overlay details-overlay-dark lh-default color-fg-default hx_rsm" open>
            <summary role="button" aria-label="Close dialog"></summary>
            <details-dialog class="Box Box--overlay d-flex flex-column anim-fade-in fast hx_rsm-dialog hx_rsm-modal">
                <button class="Box-btn-octicon m-0 btn-octicon position-absolute right-0 top-0" type="button" aria-label="Close dialog" data-close-dialog>
                    <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-x">
                        <path d="M3.72 3.72a.75.75 0 0 1 1.06 0L8 6.94l3.22-3.22a.749.749 0 0 1 1.275.326.749.749 0 0 1-.215.734L9.06 8l3.22 3.22a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215L8 9.06l-3.22 3.22a.751.751 0 0 1-1.042-.018.751.751 0 0 1-.018-1.042L6.94 8 3.72 4.78a.75.75 0 0 1 0-1.06Z"></path>
                    </svg>
                </button>
                <div class="octocat-spinner my-6 js-details-dialog-spinner"></div>
            </details-dialog>
        </details>
    </template>

    <div class="Popover js-hovercard-content position-absolute" style="display: none; outline: none;" tabindex="0">
        <div class="Popover-message Popover-message--bottom-left Popover-message--large Box color-shadow-large" style="width:360px;">
        </div>
    </div>

    <template id="snippet-clipboard-copy-button">
        <div class="zeroclipboard-container position-absolute right-0 top-0">
            <clipboard-copy aria-label="Copy" class="ClipboardButton btn js-clipboard-copy m-2 p-0 tooltipped-no-delay" data-copy-feedback="Copied!" data-tooltip-direction="w">
                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-copy js-clipboard-copy-icon m-2">
                    <path d="M0 6.75C0 5.784.784 5 1.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-1.5a.75.75 0 0 1 1.5 0v1.5A1.75 1.75 0 0 1 9.25 16h-7.5A1.75 1.75 0 0 1 0 14.25Z"></path><path d="M5 1.75C5 .784 5.784 0 6.75 0h7.5C15.216 0 16 .784 16 1.75v7.5A1.75 1.75 0 0 1 14.25 11h-7.5A1.75 1.75 0 0 1 5 9.25Zm1.75-.25a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25Z"></path>
                </svg>
                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check js-clipboard-check-icon color-fg-success d-none m-2">
                    <path d="M13.78 4.22a.75.75 0 0 1 0 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L2.22 9.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018L6 10.94l6.72-6.72a.75.75 0 0 1 1.06 0Z"></path>
                </svg>
            </clipboard-copy>
        </div>
    </template>
    <template id="snippet-clipboard-copy-button-unpositioned">
        <div class="zeroclipboard-container">
            <clipboard-copy aria-label="Copy" class="ClipboardButton btn btn-invisible js-clipboard-copy m-2 p-0 tooltipped-no-delay d-flex flex-justify-center flex-items-center" data-copy-feedback="Copied!" data-tooltip-direction="w">
                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-copy js-clipboard-copy-icon">
                    <path d="M0 6.75C0 5.784.784 5 1.75 5h1.5a.75.75 0 0 1 0 1.5h-1.5a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-1.5a.75.75 0 0 1 1.5 0v1.5A1.75 1.75 0 0 1 9.25 16h-7.5A1.75 1.75 0 0 1 0 14.25Z"></path><path d="M5 1.75C5 .784 5.784 0 6.75 0h7.5C15.216 0 16 .784 16 1.75v7.5A1.75 1.75 0 0 1 14.25 11h-7.5A1.75 1.75 0 0 1 5 9.25Zm1.75-.25a.25.25 0 0 0-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 0 0 .25-.25v-7.5a.25.25 0 0 0-.25-.25Z"></path>
                </svg>
                <svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="octicon octicon-check js-clipboard-check-icon color-fg-success d-none">
                    <path d="M13.78 4.22a.75.75 0 0 1 0 1.06l-7.25 7.25a.75.75 0 0 1-1.06 0L2.22 9.28a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018L6 10.94l6.72-6.72a.75.75 0 0 1 1.06 0Z"></path>
                </svg>
            </clipboard-copy>
        </div>
    </template>




</div>

<div id="js-global-screen-reader-notice" class="sr-only" aria-live="polite" ></div>
</body>
</html>
